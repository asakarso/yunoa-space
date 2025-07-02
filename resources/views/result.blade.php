<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Result Self-Assessment | Yunoa Space</title>
    <style>
        main {
            background-color: white;
            padding: 2rem 3rem;
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            text-align: center;
            margin: 4% 0;
        }
        h1 {
            font-weight: 700;
            font-size: 1.8rem; 
            margin-bottom: 1.5rem; 
            color: #0F5A4A;
        }
        .score-value {
            font-size: 4rem; 
            font-weight: 900;
            margin-bottom: 1rem;
            color: #0F5A4A; 
            line-height: 1;
        }
        .advice {
            font-size: 1.1rem; 
            color: #333;
            margin-bottom: 2rem; 
        }
        .additional-info {
            margin-top: 2rem;
            font-size: 0.95rem;
            color: #555;
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
        }
        .additional-info p {
            margin-bottom: 0.5rem;
        }
        .additional-info strong {
            color: #0F5A4A;
        }
        .action-button {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.8rem 1.5rem;
            background-color: #0F5A4A;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }
        .action-button:hover {
            background-color: #0b483a; 
        }
    </style>
    @vite(['resources/css/app.css'])
</head>
<body>
    <x-navbar></x-navbar>
    <main class="container">
        <h1>Hasil Self-Assessment Anda</h1>

        @if(isset($score))
            <div class="score-value">{{ $score }}</div>
            <div class="advice">
                @if($score >= 40)
                    <p>It is advisable to consult a mental health professional for further guidance.</p>
                @elseif($score >= 25)
                    <p>Pay attention to signs of stress. Try to relax more and make time for yourself.</p>
                @else
                    <p>Your mental health condition is good. Keep maintaining a healthy lifestyle and don’t hesitate to seek help if needed.</p>
                @endif
            </div>
        @else
            <p>Tidak ada data skor yang ditemukan.</p>
        @endif

        <div class="additional-info">
            @if(isset($totalAttempts) && $totalAttempts > 0)
                <p>Anda telah melakukan assessment ini sebanyak: <strong>{{ $totalAttempts }} kali</strong>.</p>
                @if(isset($latestScoreFromDb) && $totalAttempts > 1 && $latestScoreFromDb != $score)
                    <p>Skor terakhir Anda sebelumnya adalah: <strong>{{ $latestScoreFromDb }}</strong>.</p>
                @elseif(isset($latestScoreFromDb) && $totalAttempts == 1)
                     <p>Ini adalah assessment pertama Anda.</p>
                @endif
            @else
                <p>Ini adalah assessment pertama Anda.</p>
            @endif
        </div>

        <a href="{{ url('/self-assessment/test') }}" class="action-button">Ulangi Assessment</a>
        <a href="{{ url('/homepage') }}" class="action-button">Kembali ke Homepage</a>

    </main>
    <footer>
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>