<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi Kesehatan Mental - Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/articles.css'])
</head>
<body class="bg-light">
    <x-navbar></x-navbar>

    <div class="container mt-4">
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/homepage') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Artikel</li>
            </ol>
        </nav>

        {{-- Search Bar --}}
        <div class="search-bar-container my-4">
            <form action="{{ route('articles.all') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari artikel berdasarkan judul, kategori, topik" value="{{ request('search') }}">
                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Topik Terkini --}}
        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
            <h4 class="fw-bold">Topik Terkini</h4>
        </div>
        <div>
            <a href="{{ route('articles.all', ['kategori' => 'Kecemasan']) }}"
            class="topic-tag {{ request('kategori') == 'Kecemasan' ? 'active' : '' }}">
                Kecemasan
            </a>
            <a href="{{ route('articles.all', ['kategori' => 'Diet dan Nutrisi']) }}"
            class="topic-tag {{ request('kategori') == 'Diet dan Nutrisi' ? 'active' : '' }}">
                Diet dan Nutrisi
            </a>
            <a href="{{ route('articles.all', ['kategori' => 'Stres']) }}"
            class="topic-tag {{ request('kategori') == 'Stres' ? 'active' : '' }}">
                Stres
            </a>
        </div>

        {{-- Konten Artikel --}}
        <div class="row mt-5">
            {{-- Artikel Utama (Kiri) --}}
            <div class="col-lg-8">
                <h4 class="fw-bold mb-3">Artikel Terpopuler</h4>
                @if($mainArticle)
                    <a href="{{ route('articles.show', $mainArticle->id_review) }}" class="main-article-card">
                        <img src="{{ asset('storage/article_covers/' . $mainArticle->gambar_cover) }}" alt="{{ $mainArticle->judul_artikel }}">
                        <div class="card-body">
                            <h3 class="fw-bold">{{ $mainArticle->judul_artikel }}</h3>
                            <p class="text-secondary">{{ Str::limit(strip_tags($mainArticle->konten_artikel), 150) }}</p>
                        </div>
                    </a>
                @else
                    <div class="alert alert-info">Artikel utama tidak ditemukan.</div>
                @endif
            </div>

            {{-- Daftar Artikel (Kanan) --}}
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-3 mt-5 mt-lg-0 pt-lg-5">
                    @forelse ($sideArticles as $article)
                        <a href="{{ route('articles.show', $article->id_review) }}" class="side-article-item">
                            <img src="{{ asset('storage/article_covers/' . $article->gambar_cover) }}" alt="{{ $article->judul_artikel }}">
                            <div>
                                <p class="fw-bold mb-1">{{ $article->judul_artikel }}</p>
                                {{-- <small class="text-muted">Kecemasan • 5 menit</small> --}}
                                <small class="text-muted">{{ $article->kategori }}</small>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-muted mt-4">Tidak ada artikel lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
                {{-- Bagian Artikel Terbaru --}}
        <div class="latest-articles-section mt-5 pt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Artikel Terbaru</h4>
            <a href="{{ route('articles.all') }}" class="fw-bold text-decoration-none" style="color: #E91E63;">Lihat Semua</a>
            </div>

            <div class="row g-4">
                @forelse ($latestArticles as $article)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('articles.show', $article->id_review) }}" class="latest-article-card">
                            <img src="{{ asset('storage/article_covers/' . $article->gambar_cover) }}" alt="{{ $article->judul_artikel }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->judul_artikel }}</h5>
                                <p class="card-text mt-2">{{ Str::limit($article->konten_artikel, 100) }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- Kosongkan jika tidak ada artikel terbaru, atau beri pesan --}}
                @endforelse
            </div>
        </div>
        {{-- Akhir Bagian Artikel Terbaru --}}
    </div>

    <footer class="mt-5 bg-white text-black">
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>