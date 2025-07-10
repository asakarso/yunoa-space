<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi | Yunoa Space</title>
    
    @vite(['resources/css/app.css'])
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
        .consultation-item.is-finished {
            opacity: 0.75;
            background-color: #f8f9fa;
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
    <x-navbar></x-navbar>

    <main class="py-5">
        <div class="container">
            <div class="consultation-list-container shadow-lg">
                <div class="list-header d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h2 class="fw-bold mb-1">Daftar <span class="colors-ijo-tua">Konsultasi</span> Anda</h2>
                        <p class="text-muted mb-0">Pilih percakapan untuk melihat atau melanjutkan konsultasi.</p>
                    </div>
                    <div>
                        <a href="{{ route('consultation') }}" class="btn btn-yunoa-primary">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Konsultasi
                        </a>
                    </div>
                </div>

                <div class="consultation-list">
                    @forelse ($konsultasi_list as $konsultasi)
                        @php
                            $lawanBicara = $konsultasi->id_user == auth()->id() ? $konsultasi->dokter : $konsultasi->user;
                        @endphp
                        
                        <a href="{{ route('chat', $konsultasi->id_konsul) }}" class="consultation-item {{ $konsultasi->status == 'selesai' ? 'is-finished' : '' }}">
                            <img src="{{ asset('storage/' . $lawanBicara->foto_profil) }}" alt="Foto Profil">
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold">{{ $lawanBicara->nama_user }}</h5>
                                    
                                    @if($konsultasi->pesan_terakhir?->created_at)
                                        <small class="text-muted fw-light">{{ $konsultasi->pesan_terakhir->created_at->diffForHumans() }}</small>
                                    @endif
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <p class="mb-0 text-muted text-truncate" style="max-width: 80%;">
                                        {{-- Tampilkan siapa yang mengirim pesan terakhir --}}
                                        @if($konsultasi->pesan_terakhir)
                                            @if($konsultasi->pesan_terakhir->id_pengirim == auth()->id())
                                                <span class="fw-bold">Anda:</span> 
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
                            <i class="bi bi-chat-quote"></i>
                            <h4 class="mt-4">Belum Ada Percakapan</h4>
                            <p class="text-muted">Semua riwayat konsultasi Anda akan muncul di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container text-center py-3">
            <p class="m-0">© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>