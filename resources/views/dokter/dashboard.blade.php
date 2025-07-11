<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Yunoa Space</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('landing-page/style.css') }}">
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])
</head>

<body>
    <!-- Navbar Dokter -->
    <nav class="navbar container mt-4 d-flex justify-content-between">
        <a class="navbar-brand" href="{{ route('dokter.dashboard') }}">
            <img src="{{ asset('landing-page/logo.png') }}" alt="Yunoa Space" width="160px">
        </a>

        <div class="d-flex gap-5 align-items-center colors-ijo-tua">
            <a href="{{ route('dokter.dashboard.patients') }}" class="fw-semibold text-decoration-none">
                Daftar Pasien
            </a>

            <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
                @csrf
                <button type="submit" class="d-flex align-items-center gap-2 bg-transparent border-0 fw-semibold colors-ijo-tua">
                    <i class="bi bi-box-arrow-right fs-5"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container mt-5">
        <h1 class="fw-bold">Selamat Datang, Dr. {{ Auth::user()->name }}</h1>
        <p class="mb-4">Ini adalah dashboard utama Anda. Gunakan menu di atas untuk melihat daftar pasien atau keluar dari sistem.</p>

        <div class="card shadow-sm rounded-4 p-4 mb-4">
            <h4 class="colors-ijo">Panduan Singkat</h4>
            <ul>
                <li>Lihat semua pasien yang sedang berkonsultasi dengan Anda di menu "Daftar Pasien".</li>
                <li>Setelah sesi selesai, isi laporan diagnosis untuk pasien tersebut.</li>
                <li>Review dari pasien Anda akan muncul di bawah ini.</li>
            </ul>
        </div>

        <!-- Tempat Review Dokter -->
        <div class="card shadow-sm rounded-4 p-4">
            <h4 class="colors-ijo mb-3">Ulasan dari Pasien</h4>
            <p>Belum ada ulasan yang masuk.</p>
        </div>
    </main>

    <footer class="mt-5 bg-white text-black">
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
