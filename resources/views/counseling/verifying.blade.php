<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Verifikasi | Yunoa Space</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --yunoa-green: #6BB99F; }
        body { background-color: #f8f9fa; }
        .verification-container {
            text-align: center; max-width: 600px;
            margin: 5rem auto; padding: 3rem;
            background-color: white; border-radius: 16px;
            box-shadow: 0 4px Halaman Verifikasi Pembayaran20px rgba(0,0,0,0.08);
        }
        .verification-icon {
            font-size: 5rem; color: var(--yunoa-green);
        }
        .btn-yunoa-green {
            background-color: var(--yunoa-green); color: white;
            font-weight: 600; padding: 0.75rem 1.5rem;
            border: none; transition: background-color 0.2s ease;
        }
        .btn-yunoa-green:hover { background-color: #5aa88f; color: white; }
    </style>
</head>
<body>
    <x-navbar></x-navbar>

    <div class="container">
        <div class="verification-container">
            <div class="verification-icon mb-4">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <h1 class="fw-bold">Terima Kasih!</h1>
            <p class="lead text-muted mb-4">
                Bukti pembayaran Anda telah kami terima. Tim kami akan segera melakukan verifikasi dalam waktu 1x24 jam.
            </p>
            <a href="{{ route('homepage') }}" class="btn btn-yunoa-green">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>