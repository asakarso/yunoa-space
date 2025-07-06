<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi | Yunoa Space</title>
    
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root { --yunoa-green: #6BB99F; --yunoa-light-green: #e6f3ef; }
        body { background-color: #f8f9fa; }
        main { min-height: calc(100vh - 120px); }
        .consultation-list-container { background-color: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem; width: 100%; max-width: 900px; margin: auto; }
        .list-header { padding-bottom: 1.5rem; border-bottom: 1px solid #e9ecef; margin-bottom: 1.5rem; }
        .list-header h2 .colors-ijo-tua { color: var(--yunoa-green); }
        .consultation-item { display: flex; align-items: center; padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1rem; border: 1px solid #e9ecef; transition: transform 0.2s ease, box-shadow 0.2s ease; gap: 1rem; }
        a.consultation-item { text-decoration: none; color: inherit; }
        a.consultation-item:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.1); border-color: var(--yunoa-green); }
        .consultation-item img { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; flex-shrink: 0; }
        .empty-state { padding: 4rem 2rem; border: 2px dashed #e0e0e0; border-radius: 12px; background-color: #fafafa; }
        .empty-state i { font-size: 3rem; color: #ced4da; }
        .consultation-list h5 { font-size: 1.1rem; }
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
                        {{-- Ganti route ke nama baru yang lebih konsisten --}}
                        <a href="{{ route('consultation.index') }}" class="btn btn-primary-yunoa">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Konsultasi
                        </a>
                    </div>
                </div>

                <div class="consultation-list mt-4">

                    {{-- === BAGIAN KONSULTASI AKTIF === --}}
                    @if($activeConsultations->isNotEmpty())
                        <h5 class="text-muted mb-3">Aktif</h5>
                        @foreach ($activeConsultations as $consultation)
                            <a href="{{ route('chat.show', $consultation->doctor->id_user) }}" class="consultation-item">
                                <img src="{{ $consultation->doctor->foto_profil ? asset('storage/' . $consultation->doctor->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-bold">{{ $consultation->doctor->nama_user }}</h5>
                                        @if($consultation->last_message_time)
                                            <small class="text-muted fw-light">{{ $consultation->last_message_time->diffForHumans() }}</small>
                                        @endif
                                    </div>
                                    <p class="mb-0 text-muted mt-1 text-truncate">
                                        {{ $consultation->last_message }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    {{-- === BAGIAN KONSULTASI MENUNGGU PROSES === --}}
                    @if($pendingConsultations->isNotEmpty())
                        <h5 class="text-muted mt-4 mb-3">Dalam Proses</h5>
                        @foreach ($pendingConsultations as $consultation)
                            {{-- Item ini tidak bisa diklik --}}
                            <div class="consultation-item bg-light">
                                <img src="{{ $consultation->doctor->foto_profil ? asset('storage/' . $consultation->doctor->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil">
                                <div class="w-100">
                                    <h5 class="mb-0 fw-bold">{{ $consultation->doctor->nama_user }}</h5>
                                    @if ($consultation->status == 'menunggu verifikasi')
                                        <p class="mb-0 mt-1 text-warning fw-semibold"><i class="bi bi-hourglass-split me-2"></i>Menunggu persetujuan admin...</p>
                                    @else
                                        {{-- Pengguna bisa klik ini untuk kembali ke halaman pembayaran --}}
                                        <a href="{{ route('counseling.payment', $consultation->doctor->id_user) }}" class="text-decoration-none">
                                            <p class="mb-0 mt-1 text-danger fw-semibold"><i class="bi bi-credit-card me-2"></i>Menunggu pembayaran. Klik untuk melanjutkan.</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- === KONDISI JIKA SEMUANYA KOSONG === --}}
                    @if($activeConsultations->isEmpty() && $pendingConsultations->isEmpty() && $completedConsultations->isEmpty())
                        <div class="text-center empty-state mt-4">
                            <i class="bi bi-chat-quote"></i>
                            <h4 class="mt-4">Belum Ada Konsultasi</h4>
                            <p class="text-muted">Semua riwayat konsultasi Anda akan muncul di sini setelah Anda memulai.</p>
                        </div>
                    @endif
                    
                    {{-- === BAGIAN KONSULTASI SELESAI (RIWAYAT) === --}}
                    @if($completedConsultations->isNotEmpty())
                        <h5 class="text-muted mt-4 mb-3">Riwayat</h5>
                         @foreach ($completedConsultations as $consultation)
                            <div class="consultation-item opacity-75">
                                {{-- ... Tampilkan riwayat konsultasi ... --}}
                            </div>
                        @endforeach
                    @endif
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