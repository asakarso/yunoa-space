<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Pasien | Yunoa Space</title>
    
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body, html {
            height: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        main {
            height: calc(100vh - 120px);
            padding: 0;
        }

        .chat-container {
            height: 100%;
            width: 100%;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e9ecef;
        }

        .foto-profil {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .chat-window {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 1.5rem;
            overflow-y: auto;
            background-color: #f1f3f5;
            display: flex;
            flex-direction: column;
        }

        .message {
            max-width: 70%;
            padding: 10px 16px;
            border-radius: 20px;
            margin-bottom: 1rem;
            word-wrap: break-word;
        }

        .message .time {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 4px;
            display: block;
            text-align: right;
        }

        .received {
            background-color: white;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }

        .sent {
            background-color: #6BB99F;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }

        .sent .time {
            color: rgba(255, 255, 255, 0.8);
        }

        .chat-input {
            padding: 1rem 1.25rem;
            border-top: 1px solid #e9ecef;
            background-color: white;
        }

        #sendButton {
            background-color: #6BB99F;
            color: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            border: none;
            transition: background-color 0.2s ease;
        }

        #sendButton:hover {
            background-color: #5aa08a;
        }

        @media (max-width: 768px) {
            .chat-container { border-radius: 0; }
            main { height: calc(100vh - 56px); }
            footer { display: none; }
        }
    </style>
</head>
<body>
    <x-navbar></x-navbar>

    <main class="d-flex align-items-center justify-content-center p-md-4">
<<<<<<< HEAD
        <div class="chat-container flex-column shadow-lg">

            <div class="chat-header flex-row gap-3 align-items-center p-4">
                <div class="flex gap-3">
                    <a href="{{ route('counselingList', auth()->user()->id_user) }}" class="text-dark">
                        <i class="bi bi-arrow-left fs-2"></i>
                    </a>
                    
                    <img src="{{ asset('storage/' . $lawanBicara->foto_profil) }}" alt="Foto Profil" class="foto-profil">    
                </div>
                <div>
                    <h4 class="fw-bold">{{ $lawanBicara->nama_user }}</h4>
=======
        <div class="chat-container shadow-lg">
            {{-- Header --}}
            <div class="chat-header gap-3">
                <a href="{{ route('dokter.dashboard.patients') }}" class="text-dark me-3">
                    <i class="bi bi-arrow-left fs-2"></i>
                </a>
                <img src="{{ asset('storage/' . $pasien->foto_profil) }}" alt="Foto Pasien" class="foto-profil">
                <div>
                    <h4 class="fw-bold mb-0">{{ $pasien->nama_user }}</h4>
>>>>>>> dokterdashboard
                    <small class="colors-ijo-tua">Online</small>
                </div>
            </div>

<<<<<<< HEAD
           
            <div class="chat-window">
                <div id="chat-messages-container" class="chat-messages bg-secondary-subtle">
=======
            {{-- Chat Area --}}
            <div class="chat-window">
                <div id="chat-messages-container" class="chat-messages">
>>>>>>> dokterdashboard
                    @foreach ($pesans as $pesan)
                        @if($pesan->id_pengirim == auth()->user()->id_user)
                            <div class="message sent">
                                <span>{{ $pesan->pesan }}</span>
                                <span class="time">{{ \Carbon\Carbon::parse($pesan->created_at)->format('H:i') }}</span>
                            </div>
                        @else
                            <div class="message received">
                                <span>{{ $pesan->pesan }}</span>
                                <span class="time">{{ \Carbon\Carbon::parse($pesan->created_at)->format('H:i') }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
<<<<<<< HEAD
                
                @if ($konsultasi->status == 'selesai')
                <div class="text-center p-3 rounded-lg" >
                    <h4 class="mt-3 fw-bold">Consultation has ended</h4>
                    <a href="{{ route('review', $konsultasi->id_konsul) }}" class="btn btn-yunoa-green mt-3">
                        <i class="bi bi-star-fill me-2"></i>
                        @if ($konsultasi->review)
                            See Your Feedback
                        @else
                            Give Feedback
                        @endif
                    </a>
                </div>
                @else
                <div class="chat-input">
                    <form method="POST" action="{{ route('chat.send') }}">
                        @csrf
                        <input type="hidden" name="id_penerima" value="{{ $lawanBicara->id_user }}">
                        <input type="hidden" name="id_konsultasi" value="{{ $konsultasi->id_konsul }}">
                        <div class="input-group">
                            <input type="text" name="pesan" class="form-control border-0" placeholder="Ketik pesan Anda di sini..." autocomplete="off" autofocus>
                            <button class="btn ms-3" type="submit" id="sendButton">
                                <i class="bi bi-send-fill"></i>
=======

                @if ($konsultasi->status == 'selesai')
                    <div class="text-center p-4">
                        <h4 class="fw-bold">Konsultasi telah selesai</h4>
                        <p class="text-muted mt-2">{{ $konsultasi->laporan_hasil }}</p>
                    </div>
                @else
                    <div class="chat-input">
                        <form method="POST" action="{{ route('dokter.chat.send') }}">
                            @csrf
                            <input type="hidden" name="id_penerima" value="{{ $pasien->id_user }}">
                            <input type="hidden" name="id_konsultasi" value="{{ $konsultasi->id_konsul }}">
                            <div class="input-group">
                                <input type="text" name="pesan" class="form-control border-0" placeholder="Ketik pesan Anda di sini..." autocomplete="off" autofocus>
                                <button class="btn ms-3" type="submit" id="sendButton">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                        </form>

                        <div class="text-end mt-3">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endConsultationModal">
                                <i class="bi bi-x-circle me-2"></i> Akhiri Konsultasi
>>>>>>> dokterdashboard
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    {{-- Modal Akhiri Konsultasi --}}
    <div class="modal fade" id="endConsultationModal" tabindex="-1" aria-labelledby="endConsultationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('dokter.konsultasi.akhiri') }}">
                @csrf
                <input type="hidden" name="id_konsultasi" value="{{ $konsultasi->id_konsul }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Akhiri Konsultasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="laporan_hasil" class="form-label">Tulis Laporan Diagnosis</label>
                            <textarea name="laporan_hasil" id="laporan_hasil" class="form-control" rows="5" placeholder="Tuliskan hasil diagnosis atau kesimpulan konsultasi..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Akhiri Konsultasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-white">
        <div class="container text-center py-1">
            <p class="m-0">© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatMessagesContainer = document.getElementById('chat-messages-container');
            if (chatMessagesContainer) {
                chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
            }
        });
    </script>
</body>
</html>
