<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurnal | Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/landingpage.css'])
    <style>
        body { background-color: #e6f4ea; font-family: 'Segoe UI', sans-serif; padding: 20px; color: #2e4738; }
        .form-container { max-width: 600px; margin: auto; background-color: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.08); }
        input, textarea, select { width: 100%; margin: 10px 0; padding: 10px; border: 1px solid #b5d1bd; border-radius: 8px; }
        button { background-color: #86c7a7; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; }
        button:hover { background-color: #69b892; }
        img { margin-top: 10px; max-width: 100%; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Jurnal</h2>

    <form action="{{ route('journals.update', $journal->id_jurnal) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="judul_jurnal" value="{{ $journal->judul_jurnal }}" required>
        <input type="date" name="tanggal_jurnal" value="{{ $journal->tanggal_jurnal }}" required>
        <input type="time" name="waktu_jurnal" value="{{ $journal->waktu_jurnal }}" required>
        <textarea name="konten_jurnal" rows="6" required>{{ $journal->konten_jurnal }}</textarea>

        @if ($journal->gambar_cover)
            <img src="{{ asset('storage/' . $journal->gambar_cover) }}" alt="Cover Jurnal">
        @endif

        <input type="file" name="gambar_cover">

        <button type="submit">Perbarui Jurnal</button>
    </form>
</div>

</body>
</html>
