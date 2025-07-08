<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/profile.css'])
</head>
<body style="background-color: #f8f9fa;">
    <x-navbar></x-navbar>

    <div class="container my-5">
        <div class="row g-4">

            <div class="col-lg-4 profile-sidebar">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : 'https://via.placeholder.com/150' }}" alt="Foto Profil" class="profile-avatar">
                        <h4 class="fw-bold mb-1">{{ $user->nama_user }}</h4>
                        <p class="text-muted">{{ $user->email_user }}</p>
                        <hr>
                        <div class="text-start">
                            <p class="mb-2">
                                <i class="bi bi-telephone-fill text-success me-2"></i>
                                {{ $user->nomor_telepon }}
                            </p>
                            <p class="mb-0">
                                <i class="bi bi-clipboard2-pulse-fill text-success me-2"></i>
                                Total Konseling: {{ $user->total_konseling }} Sesi
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 main-content">
                <h4 class="fw-bold mb-3">Aktivitas Saya</h4>

                <a href="{{ url('self-assessment/result') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Riwayat Self-Assessment</h5>
                                <p class="card-text text-muted mb-0">Lihat kembali hasil tes kesehatan mental Anda.</p>
                            </div>
                            <i class="bi bi-chevron-right fs-4 text-muted"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('journals.index') }}" class="text-decoration-none">
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Jurnal Saya</h5>
                                <p class="card-text text-muted mb-0">Baca dan kelola semua catatan jurnal harian Anda.</p>
                            </div>
                            <i class="bi bi-chevron-right fs-4 text-muted"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('counselingList', $user->id_user) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Riwayat Konseling</h5>
                                <p class="card-text text-muted mb-0">Lihat riwayat percakapan dengan para ahli.</p>
                            </div>
                            <i class="bi bi-chevron-right fs-4 text-muted"></i>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</body>
</html>