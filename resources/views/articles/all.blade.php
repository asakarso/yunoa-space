<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Artikel - Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/articles.css'])
</head>
<body class="bg-light">
    <x-navbar></x-navbar>

    <div class="container my-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Semua</li>
            </ol>
        </nav>

        <h2 class="fw-bold mb-4">Semua Artikel</h2>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('articles.show', $article->id_review) }}" class="latest-article-card">
                        <img src="{{ asset('storage/article_covers/' . $article->gambar_cover) }}" alt="{{ $article->judul_artikel }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->judul_artikel }}</h5>
                            <p class="card-text mt-2">{{ Str::limit(strip_tags($article->konten_artikel), 100) }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Tidak ada artikel yang ditemukan.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Ini akan otomatis menampilkan link navigasi halaman 1, 2, 3, dst. --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </div>

    <footer class="mt-5 bg-white text-black">
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>