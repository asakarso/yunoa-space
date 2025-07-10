<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Midtrans\Config;
use App\Models\Consultation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Midtrans\Snap;

class CounselingController extends Controller
{
    public function showDoctors(Request $request)
    {
        $query = User::whereHas('roles', function ($q) {
            $q->where('nama_role', 'dokter');
        })
        ->whereHas('doctor', function ($q) {
            $q->whereNotNull('verified_at');
        })
        ->with('doctor');
        

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_user', 'like', '%' . $request->search . '%');
        }

        $doctors = $query->get();
        return view('consultation', compact('doctors'));
    }

    public function showPayment($doctor_id)
    {
        $user = Auth::user();

        if ($user->total_konseling < 1) {
            return redirect()->route('consultation')->with('error', 'Kamu belum pernah melakukan konsultasi gratis.');
        }

        $doctor = User::with('doctor')->findOrFail($doctor_id);
        if (!$doctor || !$doctor->doctor) {
            return redirect()->route('consultation')->with('error', 'Profil dokter tidak ditemukan.');
        }
          $orderId = 'KONSUL-' . $user->id_user . '-' . $doctor->id_user . '-' . time();
        $amount = (int) $doctor->doctor->consultation_price;

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $user->nama_user,
                'email' => $user->email_user,
                'phone' => $user->nomor_telepon ?? '081234567890',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }

        return view('counseling.payment', [
            'doctor' => $doctor,
            'snapToken' => $snapToken,
        ]);
    }

    public function finishPayment(Request $request)
    {
        $orderId = $request->query('order_id');
        if (!$orderId) {
            return redirect()->route('consultation')->with('error', 'Transaksi tidak valid.');
        }

        $serverKey = config('midtrans.server_key');
        $authString = base64_encode($serverKey . ':'); 

        $apiUrl = config('midtrans.is_production')
            ? "https://api.midtrans.com/v2/{$orderId}/status"
            : "https://api.sandbox.midtrans.com/v2/{$orderId}/status";
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $authString,
        ])->get($apiUrl);

        if (!$response->successful()) {
            return redirect()->route('consultation')->with('error', 'Gagal memverifikasi status pembayaran.');
        }

        $transaction = $response->json();
        $transactionStatus = $transaction['transaction_status'];
        $fraudStatus = $transaction['fraud_status'];

        if (in_array($transactionStatus, ['capture', 'settlement']) && $fraudStatus == 'accept') {
            DB::transaction(function () use ($transaction) {
                $orderId = $transaction['order_id'];
                
                $parts = explode('-', $orderId);
                $userId = $parts[1];
                $doctorId = $parts[2];
                
                $payment = Payment::updateOrCreate(
                    ['order_id' => $orderId],
                    [
                        'user_id' => $userId,
                        'doctor_id' => $doctorId,
                        'amount' => $transaction['gross_amount'],
                        'method' => $transaction['payment_type'],
                        'status' => 'success',
                    ]
                );

                // Buat data Consultation
                Consultation::updateOrCreate(
                    ['id_payment' => $payment->id],
                    [
                        'id_user' => $userId,
                        'id_dokter' => $doctorId,
                        'status' => 'aktif',
                        'tanggal_konsultasi' => now()->toDateString(),
                        'jam_mulai' => now()->toTimeString(),
                    ]
                );
            });

            return redirect()->route('counselingList', auth()->id())->with('success', 'Pembayaran berhasil dan sesi konsultasi telah dibuat!');
        }

        return redirect()->route('consultation')->with('error', 'Pembayaran Anda masih tertunda atau gagal.');
    }


    public function reviewForm($consultId, Request $request)
    {
        $isEdit = $request->query('isEdit', false);
        $konsultasi = Consultation::findOrFail($consultId);
        $dokter = User::findOrFail($konsultasi->id_dokter);
        $review = Review::where('id_konsul', $consultId)->first();

        return view('user.review', compact('konsultasi', 'dokter', 'review', 'isEdit'));
    }


    public function storeReview(Request $request, $consultId)
    {
        $user = Auth::user();

        Review::create([
            'id_user' => $user->id_user,
            'id_dokter' => $request->dokterId,
            'id_konsul' => $consultId,
            'tanggal_review' => now()->format('Y-m-d'),
            'waktu_review' => now()->format('H:i:s'),
            'rating' => $request->rating,
            'deskripsi_review' => $request->deskripsi_review,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('review', $consultId);
    }


    public function editReview(Request $request, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update([
            'tanggal_review' => now()->format('Y-m-d'),
            'waktu_review' => now()->format('H:i:s'),
            'rating' => $request->rating,
            'deskripsi_review' => $request->deskripsi_review,
            'updated_at' => now(),
        ]);

        return redirect()->route('review', $review->id_konsul);
    }

    public function counselingList(Request $request)
    {
        $authUserId = Auth::id();

        $konsultasi_list = Consultation::with(['user', 'dokter', 'pesan_terakhir'])
            ->where(function ($q) use ($authUserId) {
                $q->where('id_user', $authUserId)
                  ->orWhereHas('dokter', function ($subQ) use ($authUserId) {
                      $subQ->where('users.id_user', $authUserId);
                  });
            })
            ->withMax('pesan_terakhir as last_message_at', 'created_at')
            ->orderByRaw("CASE WHEN status = 'selesai' THEN 1 ELSE 0 END ASC")
            ->orderByDesc('last_message_at')
            ->get();

        return view('counselingList', compact('konsultasi_list'));
    }
}
