<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Konseling | Yunoa Space</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --yunoa-green: #6BB99F; --yunoa-light-green: #e6f3ef; }
        body { background-color: #f8f9fa; }
        main { min-height: calc(100vh - 120px); }
        .payment-container { background-color: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2.5rem; width: 100%; max-width: 700px; margin: auto; }
        .list-header { padding-bottom: 1.5rem; border-bottom: 1px solid #e9ecef; margin-bottom: 1.5rem; }
        .list-header h2 .colors-ijo-tua { color: var(--yunoa-green); }
        .doctor-info { display: flex; align-items: center; gap: 1rem; background-color: var(--yunoa-light-green); border: 1px solid var(--yunoa-green); color: #333; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; }
        .doctor-info img { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; }
        .btn-yunoa-green { background-color: var(--yunoa-green); color: white; font-weight: 600; padding: 0.75rem 1.5rem; border: none; transition: background-color 0.2s ease; }
        .btn-yunoa-green:hover { background-color: #5aa88f; color: white; }
        .form-select-lg { padding-top: .7rem; padding-bottom: .7rem; }
        .bank-option { padding: 0.75rem 1rem; border: 1px solid #dee2e6; border-radius: 8px; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 1rem; cursor: pointer; }
        .bank-option:has(input:checked) { border-color: var(--yunoa-green); background-color: var(--yunoa-light-green); }
        .bank-logo-container { width: 100px; height: 35px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .bank-logo { max-width: 100%; max-height: 100%; object-fit: contain; }
    </style>
</head>
<body>
    {{-- === KODE YANG DIPERBARUI: Menambahkan nomor rekening dan memindahkan array ke atas === --}}
    @php
        $banks = [
            ['value' => 'bca', 'name' => 'Bank BCA', 'logo' => asset('images/banks/bca.png'), 'account_number' => '123-456-7890'],
            ['value' => 'bni', 'name' => 'Bank BNI', 'logo' => asset('images/banks/bni.png'), 'account_number' => '098-765-4321'],
            ['value' => 'bri', 'name' => 'Bank BRI', 'logo' => asset('images/banks/bri.png'), 'account_number' => '555-444-3333'],
            ['value' => 'mandiri', 'name' => 'Bank Mandiri', 'logo' => asset('images/banks/mandiri.png'), 'account_number' => '111-222-3333'],
            ['value' => 'cimb', 'name' => 'Bank CIMB Niaga', 'logo' => asset('images/banks/cimb.png'), 'account_number' => '777-888-9999'],
            ['value' => 'danamon', 'name' => 'Bank Danamon', 'logo' => asset('images/banks/danamon.png'), 'account_number' => '666-555-4444'],
            ['value' => 'permata', 'name' => 'Bank Permata', 'logo' => asset('images/banks/permata.png'), 'account_number' => '222-333-4444'],
            ['value' => 'bukopin', 'name' => 'Bank Bukopin', 'logo' => asset('images/banks/bukopin.png'), 'account_number' => '888-999-0000'],
            // Anda bisa mengubah nomor rekening atau menambahkan bank lain di sini
        ];
    @endphp

    <x-navbar></x-navbar>

    <main class="py-5">
        <div class="container">
            <div class="payment-container shadow-lg">
                
                <div class="list-header">
                    <h2 class="fw-bold mb-1">Konfirmasi <span class="colors-ijo-tua">Pembayaran</span></h2>
                    <p class="text-muted mb-0">Selesaikan pembayaran untuk memulai sesi konseling Anda.</p>
                </div>
                @if ($doctor)
                    <div class="doctor-info">
                        <img src="{{ $doctor->foto_profil ? asset('storage/' . $doctor->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil {{ $doctor->nama_user }}">
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $doctor->nama_user }}</h4>
                            <p class="mb-0 text-muted">{{ $doctor->specialization ?? 'Psikolog Profesional' }}</p>
                        </div>
                    </div>
                @endif
                
                @if (!$selectedMethod && $errors->any())
                    <div class="alert alert-danger">
                        <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                    </div>
                @endif

                @if (!$selectedMethod)
                    <form method="POST" action="{{ route('counseling.processPayment', $doctor->id_user) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="paymentMethod" class="form-label fw-semibold">Pilih Metode Pembayaran</label>
                            <select name="method" id="paymentMethod" class="form-select form-select-lg" required>
                                <option value="" selected>-- Pilih --</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>

                        <div id="bank-options-container" style="display: none;">
                            <label class="form-label fw-semibold">Pilih Bank</label>
                            @foreach ($banks as $bank)
                            <label class="bank-option">
                                <input type="radio" name="bank" value="{{ $bank['value'] }}" class="form-check-input">
                                <div class="bank-logo-container">
                                    <img src="{{ $bank['logo'] }}" alt="{{ $bank['name'] }}" class="bank-logo">
                                </div>
                                <span>{{ $bank['name'] }}</span>
                            </label>
                            @endforeach
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fs-5 text-muted">Total Biaya:</span>
                            <span class="fs-4 fw-bold">Rp{{ number_format($doctor->consultation_price, 0, ',', '.') }}</span>
                        </div>
                        <button type="submit" class="btn btn-yunoa-green w-100"><i class="bi bi-shield-lock me-2"></i>Lanjutkan</button>
                    </form>
                @else
                    {{-- HALAMAN 2: VERIFIKASI PEMBAYARAN DENGAN UPLOAD BUKTI --}}
                    @php
                        // Mencari detail bank yang dipilih dari array $banks di atas
                        $selectedBankDetails = null;
                        foreach ($banks as $bank) {
                            if ($bank['value'] === $payment->payment_detail) {
                                $selectedBankDetails = $bank;
                                break;
                            }
                        }
                    @endphp

                    <div class="mb-4">
                        <p class="mb-1"><strong>Metode Terpilih:</strong> <span class="badge bg-success fs-6">{{ strtoupper($selectedMethod) }}</span></p>
                        @if($payment->payment_detail && in_array($selectedMethod, ['transfer', 'va']))
                            <p class="mb-1"><strong>Bank Terpilih:</strong> <span class="text-uppercase fw-bold">{{ $payment->payment_detail }}</span></p>
                        @endif
                        <p><strong>Total Biaya:</strong> <span class="fw-bold">Rp{{ number_format($payment->amount, 0, ',', '.') }}</span></p>
                    </div>

                    <form action="{{ route('counseling.verifyPayment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (in_array($selectedMethod, ['transfer', 'va']) && $selectedBankDetails)
                           <div class="alert alert-info">
                                {{-- Menampilkan nomor rekening yang dinamis --}}
                                Silakan lakukan transfer ke rekening <strong>{{ strtoupper($selectedBankDetails['name']) }}</strong> a.n Yunoa Space dengan nomor rekening:
                                <h4 class="text-center my-2 user-select-all">{{ $selectedBankDetails['account_number'] }}</h4>
                           </div>
                        @endif
                        @if ($selectedMethod === 'qris')
                            <div class="d-flex flex-column align-items-center my-4">
                                <p class="fw-semibold mb-3">Silakan scan QR Code di bawah ini menggunakan aplikasi E-Wallet Anda:</p>
                                <div class="qris-container" style="max-width: 280px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                                    <img src="{{ asset('images/qris-example.png') }}" alt="Scan QRIS untuk Pembayaran" style="max-width: 100%; height: auto; display: block;">
                                </div>
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="payment_proof" class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                            <input class="form-control" type="file" name="payment_proof" id="payment_proof" required>
                            <small class="form-text text-muted">Upload screenshot bukti transfer atau pembayaran QRIS Anda (JPG, PNG, maks 2MB).</small>
                        </div>
                        @error('payment_proof')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="method" value="{{ $selectedMethod }}">
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id_user }}">
                        <hr class="my-4">
                        <button type="submit" class="btn btn-yunoa-green w-100"><i class="bi bi-check-circle me-2"></i>Konfirmasi & Ajukan Verifikasi</button>
                    </form>
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container text-center py-3">
            <p class="m-0">© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodSelect = document.getElementById('paymentMethod');
            if (paymentMethodSelect) {
                const bankOptionsContainer = document.getElementById('bank-options-container');
                const bankRadios = document.querySelectorAll('input[name="bank"]');
                paymentMethodSelect.addEventListener('change', function() {
                    if (this.value === 'transfer') {
                        bankOptionsContainer.style.display = 'block';
                        bankRadios.forEach(radio => radio.required = true);
                    } else {
                        bankOptionsContainer.style.display = 'none';
                        bankRadios.forEach(radio => { radio.required = false; radio.checked = false; });
                    }
                });
            }
        });
    </script>
</body>
</html>