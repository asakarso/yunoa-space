<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jurnal | Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])
    <style>
        body {
            background-color: #e6f4ea;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            color: #2e4738;
        }
        .journal-box {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        }
        h2 {
            color: #2c5c40;
        }
        img {
            max-width: 100%;
            margin: 20px 0;
            border-radius: 10px;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            margin-right: 10px;
            padding: 10px 18px;
            background-color: #86c7a7;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #69b892;
        }
        .btn-delete {
            background-color: #e27777;
        }
        .btn-delete:hover {
            background-color: #c75a5a;
        }
        .btn-back {
            background-color: #b0c7ba;
        }
        .btn-back:hover {
            background-color: #9ab5a9;
        }
        .meta {
            color: #6a8f7a;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="journal-box">
    <h2>{{ $journal->judul_jurnal }}</h2>
    <div class="meta">{{ $journal->tanggal_jurnal }} - {{ $journal->waktu_jurnal }}</div>

    @if ($journal->gambar_cover)
        <img src="{{ asset('storage/' . $journal->gambar_cover) }}" alt="Cover Jurnal">
    @endif

    <p>{{ $journal->konten_jurnal }}</p>

    <a href="{{ route('journals.edit', $journal->id_jurnal) }}" class="btn">Edit</a>

    <form action="{{ route('journals.destroy', $journal->id_jurnal) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete" onclick="return confirm('Hapus jurnal ini?')">Hapus</button>
    </form>

    <a href="{{ route('journals.index') }}" class="btn btn-back">Kembali</a>
</div>

</body>
</html>
