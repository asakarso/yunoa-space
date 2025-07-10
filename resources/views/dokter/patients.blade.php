<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pasien | Yunoa Space</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('landing-page/style.css') }}">
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --yunoa-green: #6BB99F;
            --yunoa-light-green: #e6f3ef;
        }
        body {
            background-color: #f8f9fa;
        }
        main { 
            min-height: calc(100vh - 120px);
        }
        .consultation-list-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 2rem;
            width: 100%;
            max-width: 900px;
            margin: auto;
        }
        .list-header {
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1.5rem;
        }
        .list-header h2 .colors-ijo-tua {
            color: var(--yunoa-green);
        }
        .consultation-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            text-decoration: none;
            color: inherit;
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            gap: 1rem;
        }
        .consultation-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-color: var(--yunoa-green);
        }
        .consultation-item img {
            width: 60px; 
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            flex-shrink: 0; 
        }
        .empty-state {
            padding: 4rem 2rem;
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            background-color: #fafafa;
        }
        .empty-state i {
            font-size: 3rem;
            color: #ced4da;
        }
    </style>
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
    <main class="py-5">
        <div class="container">
            <div class="consultation-list-container shadow-lg">
                <div class="list-header d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h2 class="fw-bold mb-1">Pasien <span class="colors-ijo-tua">Anda</span></h2>
                        <p class="text-muted mb-0">Daftar semua pasien yang pernah berkonsultasi dengan Anda.</p>
                    </div>
                </div>
                <div class="consultation-list">
                    @forelse ($konsultasi_list as $konsultasi)
                        @php
                            $pasien = $konsultasi->user;
                        @endphp
                        
                        <a href="{{ route('dokter.chat', $konsultasi->id_konsul) }}" class="consultation-item">
                            <img src="{{ asset('storage/' . $pasien->foto_profil) }}" alt="Foto Profil">
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold">{{ $pasien->nama_user }}</h5>
                                    @if($konsultasi->pesan_terakhir?->created_at)
                                        <small class="text-muted fw-light">{{ $konsultasi->pesan_terakhir->created_at->diffForHumans() }}</small>
                                    @endif
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <p class="mb-0 text-muted text-truncate" style="max-width: 80%;">
                                        @if($konsultasi->pesan_terakhir)
                                            @if($konsultasi->pesan_terakhir->id_pengirim == auth()->id())
                                                <span class="fw-bold">Anda:</span>
                                            @else
                                                <span class="fw-bold">{{ $pasien->nama_user }}:</span>
                                            @endif
                                            {{ $konsultasi->pesan_terakhir->pesan }}
                                        @else
                                            Belum ada pesan.
                                        @endif
                                    </p>

                                    @if($konsultasi->status == 'selesai')
                                        <span class="badge rounded-pill bg-secondary fw-normal">
                                            <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center empty-state">
                            <i class="bi bi-person-x"></i>
                            <h4 class="mt-4">Belum Ada Pasien</h4>
                            <p class="text-muted">Pasien yang telah berkonsultasi dengan Anda akan tampil di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white text-black mt-5">
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
