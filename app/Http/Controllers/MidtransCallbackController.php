<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Consultation;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    /**
     * Menangani notifikasi (webhook) dari Midtrans.
     */
    public function callback(Request $request)
    {
        // 1. Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 2. Buat instance notifikasi dari Midtrans
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid notification'], 400);
        }

        // 3. Ambil informasi penting dari notifikasi
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;
        $orderId = $notification->order_id;
        $statusCode = $notification->status_code;
        $grossAmount = $notification->gross_amount;
        $signatureKey = $notification->signature_key;

        // 4. Ambil ID pembayaran dari order_id
        $paymentId = explode('-', $orderId)[0];
        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // 5. Jangan proses ulang
        if ($payment->status === 'berhasil') {
            return response()->json(['message' => 'Already processed']);
        }

        // 6. Verifikasi signature key
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . config('midtrans.server_key'));
        if ($signatureKey !== $expectedSignature) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // 7. Proses status transaksi
        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            if ($fraudStatus === 'accept') {
                $payment->status = 'berhasil';
                $this->activateConsultation($payment);
            }
        } elseif ($transactionStatus === 'pending') {
            $payment->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $payment->status = 'gagal';
        }

        $payment->save();

        return response()->json(['message' => 'Callback processed']);
    }

    /**
     * Aktifkan konsultasi setelah pembayaran berhasil.
     */
    protected function activateConsultation(Payment $payment)
    {
        $consultation = Consultation::where('id_user', $payment->user_id)
            ->where('id_dokter', $payment->doctor_id)
            ->where('status', 'menunggu')
            ->latest('id_konsul')
            ->first();

        if ($consultation) {
            $consultation->status = 'aktif';
            $consultation->save();
        }
    }
}
