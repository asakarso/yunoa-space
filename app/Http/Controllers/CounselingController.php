<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Midtrans\Config;
use App\Models\Consultation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class CounselingController extends Controller
{
    public function showDoctors(Request $request)
    {
        $query = User::whereHas('roles', function ($q) {
            $q->where('nama_role', 'dokter');
        })->with('doctor');

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
            return redirect('/')->with('error', 'Kamu belum pernah melakukan konsultasi gratis.');
        }

        $userDoctor = User::with('doctor')->findOrFail($doctor_id);
        if (!$userDoctor || !$userDoctor->doctor) {
            return redirect()->route('consultation')->with('error', 'Profil dokter tidak ditemukan.');
        }

        $doctorProfile = $userDoctor->doctor;
        $amount = (int) $doctorProfile->consultation_price;

        $payment = Payment::updateOrCreate(
            [
                'user_id' => $user->id_user,
                'doctor_id' => $doctorProfile->user_id,
                'status' => 'pending',
            ],
            [
                'amount' => $amount,
                'method' => 'Midtrans',
            ]
        );

            $consultation = Consultation::updateOrCreate(
            [
                'id_user' => $user->id_user,
                'id_dokter' => $doctorProfile->user_id,
                'status' => 'menunggu',
            ],
            [
                'tanggal_konsultasi' => now()->toDateString(),
                'jam_mulai' => now()->format('H:i:s'),
                //'jam_selesai' => now()->addMinutes(30)->format('H:i:s'),
                'updated_at' => now()
            ]
        );


        $consultationId = $consultation->id_konsul;

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $payment->id . '-' . time(),
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $user->nama_user,
                'email' => $user->email_user,
                'phone' => $user->nomor_telepon ?? '081234567890',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $payment->snap_token = $snapToken;
            $payment->save();
        } catch (\Exception $e) {
            dd('Midtrans Error:', $e->getMessage());
        }

        return view('counseling.payment', [
            'payment' => $payment,
            'doctor' => $userDoctor,
            'snapToken' => $snapToken,
            'consultationId' => $consultationId,
        ]);
    }

    public function processPayment(Request $request, $doctor_id)
    {
        $request->validate([
            'method' => 'required|string'
        ]);

        $user = Auth::user();
        $doctor = User::findOrFail($doctor_id);
        $doctorDetail = $doctor->doctor;

        $payment = Payment::create([
            'user_id' => $user->id_user,
            'doctor_id' => $doctor->id_user,
            'amount' => $doctorDetail->consultation_price,
            'method' => $request->method,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $consultation = Consultation::where([
            ['id_user', '=', $user->id_user],
            ['id_dokter', '=', $doctorDetail->id],
        ])->latest()->first();

        return redirect()->route('chat', $consultation->id_konsul)
            ->with('success', 'Pembayaran berhasil disimpan.');
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
