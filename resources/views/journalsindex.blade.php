<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Journals | Yunoa Space</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('landing-page/style.css') }}">
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])

    <!-- Animate.css for animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            background: linear-gradient(to bottom right, #d9f2e7, #b4e0c7);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
            color: #2e4738;
        }

        h2 {
            color: #2c5c40;
            text-align: center;
            margin-bottom: 30px;
        }

        .journal-container {
            max-width: 900px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s;
        }

        .journal-entry {
            border-bottom: 1px solid #cbe4d4;
            padding: 20px 0;
            transition: transform 0.3s ease;
        }

        .journal-entry:hover {
            transform: translateY(-5px);
        }

        .journal-entry h3 {
            margin: 0;
            color: #326c54;
        }

        .journal-entry small {
            display: block;
            margin-bottom: 8px;
            color: #6a8f7a;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background: linear-gradient(to right, #86c7a7, #6dbb94);
            color: white;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn:hover {
            background: linear-gradient(to right, #69b892, #57a67f);
        }

        .top-btn {
            float: right;
        }

        .no-journal-message {
            text-align: center;
            color: #6a8f7a;
            padding: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="journal-container animate__animated animate__fadeInUp">
        <h2>My Journals</h2>
        <a href="{{ route('journals.create') }}" class="btn top-btn">+ New Journal</a>
        <div style="clear: both;"></div>

        @if ($journals->isEmpty())
            <div class="no-journal-message">You haven't written any journal entries yet.</div>
        @else
            @foreach ($journals as $journal)
                <div class="journal-entry">
                    <h3>{{ $journal->judul_jurnal }}</h3>
                    <small>{{ $journal->tanggal_jurnal }} at {{ $journal->waktu_jurnal }}</small>
                    <p>{{ Str::limit($journal->konten_jurnal, 150) }}</p>
                    <a href="{{ route('journals.show', $journal->id_jurnal) }}" class="btn">View</a>
                    <a href="{{ route('journals.edit', $journal->id_jurnal) }}" class="btn">Edit</a>
                </div>
            @endforeach
        @endif
    </div>

</body>
</html>
