<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Konseling | Yunoa Space</title>
    
    @vite(['resources/css/app.css'])
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- Script untuk Midtrans Snap --}}
    <script type="text/javascript"
      src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
      data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        :root {
            --yunoa-green: #6BB99F;
            --yunoa-light-green: #e6f3ef;
        }
        body { background-color: #f8f9fa; }
        main { min-height: calc(100vh - 120px); }
        .payment-container {
            background-color: white; border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2.5rem;
            width: 100%; max-width: 700px; margin: auto;
        }
        .list-header {
            padding-bottom: 1.5rem; border-bottom: 1px solid #e9ecef;
            margin-bottom: 1.5rem;
        }
        .list-header h2 .colors-ijo-tua { color: var(--yunoa-green); }
        .doctor-info {
            display: flex; align-items: center; gap: 1rem;
            background-color: var(--yunoa-light-green); border: 1px solid var(--yunoa-green);
            color: #333; padding: 1rem; border-radius: 12px; margin-bottom: 2rem;
        }
        .doctor-info img { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; }
        .btn-yunoa-green {
            background-color: var(--yunoa-green); color: white; font-weight: 600;
            padding: 0.75rem 1.5rem; border: none; transition: background-color 0.2s ease;
        }
        .btn-yunoa-green:hover { background-color: #5aa88f; color: white; }
    </style>
</head>
<body>
    <x-navbar></x-navbar>

    <main class="py-5">
        <div class="container">
            <div class="payment-container shadow-lg">
                <div class="list-header">
                    <h2 class="fw-bold mb-1">Konfirmasi <span class="colors-ijo-tua">Pembayaran</span></h2>
                    <p class="text-muted mb-0">Selesaikan pembayaran untuk memulai sesi konseling Anda.</p>
                </div>
                <div class="doctor-info">
                    <img src="{{ asset('storage/'.$doctor->foto_profil) }}" alt="Foto Profil {{ $doctor->nama_user }}">
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $doctor->nama_user }}</h4>
                        <p class="mb-0 text-muted">{{ $doctor->doctor->specialization ?? 'Psikolog Profesional' }}</p>
                    </div>
                </div>
                
                <div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fs-5 text-muted">Total Biaya:</span>
                        <span class="fs-4 fw-bold">Rp{{ number_format($doctor->doctor->consultation_price, 0, ',', '.') }}</span>
                    </div>
                    
                    <button id="pay-button" class="btn btn-yunoa-green w-100">
                        <i class="bi bi-shield-lock me-2"></i>Lanjutkan Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container text-center py-3">
            <p class="m-0">© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    // **PERUBAHAN KUNCI DI SINI**
                    // Alih-alih langsung ke counselingList, kita ke rute 'finish'
                    // sambil membawa order_id dari hasil transaksi.
                    console.log('Payment Success:', result);
                    alert("Verifying your payment..."); 
                    window.location.href = "{{ route('payment.finish') }}" + "?order_id=" + result.order_id;
                },
                onPending: function(result){
                    alert("Your payment is pending. Please follow the instructions.");
                    // Arahkan juga ke halaman finish agar statusnya bisa dicek nanti
                    window.location.href = "{{ route('payment.finish') }}" + "?order_id=" + result.order_id;
                },
                onError: function(result){
                    alert("Payment failed.");
                },
                onClose: function(){
                    alert('You closed the popup without finishing the payment.');
                }
            });
        };
    </script>

</body>
</html>