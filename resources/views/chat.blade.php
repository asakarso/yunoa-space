<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Konsultasi | Yunoa Space</title>
    
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
        }
        
        .chat-header { 
            display: flex; 
            align-items: center; 
            padding: 1rem 1.25rem; 
            border-bottom: 1px solid #e9ecef; 
            flex-shrink: 0; 
        }
        
        .chat-header h3 { 
            margin: 0; 
        }

        .foto-profil {
            width: 60px; 
            height: 60px;
            object-fit: cover;
            width: 60px; 
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
            flex-shrink: 0; 
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
        <div class="chat-container flex-column shadow-lg">
            {{-- header --}}
            <div class="chat-header flex-row gap-3 align-items-center p-4">
                <div class="flex gap-3">
                    <a href="{{ route('counselingList', auth()->user()->id_user) }}" class="text-dark">
                        <i class="bi bi-arrow-left fs-2"></i>
                    </a>
                    <img src="{{ asset('storage/' . $dokter->foto_profil) }}" alt="Foto Profil" class="foto-profil">    
                </div>
                <div>
                    <h4 class="fw-bold">{{ $dokter->nama_user }}</h4>
                    <small class="colors-ijo-tua">Online</small>
                </div>
            </div>

            {{-- Jendela Chat --}}
            <div class="chat-window">
                {{-- Area Tampilan Pesan --}}
                <div id="chat-messages-container" class="chat-messages bg-secondary-subtle">
                    @foreach ($pesans as $pesan)
                        @if($pesan->id_pengirim == auth()->user()->id_user)
                            <div class="message sent">
                                <span>{{ $pesan->pesan }}</span>
                                <span class="time">{{ $pesan->created_at->format('H:i') }}</span>
                            </div>
                        @else
                            <div class="message received">
                                <span>{{ $pesan->pesan }}</span>
                                <span class="time">{{ $pesan->created_at->format('H:i') }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if ($konsultasi->status == 'selesai')
                <div class="text-center p-3 rounded-lg" >
                    <h4 class="mt-3 fw-bold">Consultation has ended</h4>
                    
                    {{-- Tombol  review --}}
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
                {{-- Input Pesan --}}
                <div class="chat-input">
                    <form method="POST" action="{{ route('chat.send') }}">
                        @csrf
                        <input type="hidden" name="id_penerima" value="{{ $dokter->id_user }}">
                        <input type="hidden" name="id_konsultasi" value="{{ $konsultasi->id_konsul }}">
                        <div class="input-group">
                            <input type="text" name="pesan" class="form-control border-0" placeholder="Ketik pesan Anda di sini..." autocomplete="off" autofocus>
                            <button class="btn ms-3" type="submit" id="sendButton">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container text-center py-1">
            <p class="m-0">© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessagesContainer = document.getElementById('chat-messages-container');
            if(chatMessagesContainer) {
                chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
            }
        });
    </script>
</body>
</html>