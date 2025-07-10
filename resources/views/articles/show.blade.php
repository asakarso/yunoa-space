<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->judul_artikel }} | Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/articles.css'])
    <style>
        body { background-color: #f4f7f6; } /* Latar belakang abu-abu muda */
        .article-content strong {
            display: block;
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
            color: #1a202c;
            line-height: 1.4;
        }
        .article-content ul {
            padding-left: 20px;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }
        .article-content ul li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <x-navbar></x-navbar>

    <div class="container my-5">
        <div class="row">
            {{-- KOLOM KIRI: Ikon Social Media (Opsional) --}}
            <div class="col-lg-1 d-none d-lg-block">
                <div class="social-share-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- KOLOM TENGAH: Konten Utama Artikel --}}
            <div class="col-lg-7">
                <div class="article-page-container">
                    {{-- Breadcrumbs --}}
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/homepage') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->judul_artikel, 30) }}</li>
                        </ol>
                    </nav>
                    
                    {{-- Judul Artikel --}}
                    <h1 class="fw-bold mb-3 display-5">{{ $article->judul_artikel }}</h1>
                    <p class="text-muted mb-4">
                        Dipublikasikan pada {{ \Carbon\Carbon::parse($article->tanggal_artikel)->format('d F Y') }}
                    </p>

                    {{-- Gambar Cover Artikel --}}
                    <img src="{{ asset('storage/article_covers/' . $article->gambar_cover) }}" class="img-fluid rounded-3 mb-4 shadow-sm" alt="{{ $article->judul_artikel }}">
                    {{-- Isi Konten Artikel --}}
                    <div class="article-content" style="font-size: 1.1rem; line-height: 1.8;">
                        {!! $article->konten_artikel !!}
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: Sidebar --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="article-page-container">
                        <h5 class="fw-bold mb-4">Artikel Terkait</h5>
                        <div class="d-flex flex-column gap-3">
                            @forelse ($relatedArticles as $related)
                                <a href="{{ route('articles.show', $related->id_review) }}" class="side-article-item">
                                    <img src="{{ asset('storage/' . $related->gambar_cover) }}" alt="{{ $related->judul_artikel }}">
                                    <div>
                                        <p class="fw-bold mb-1">{{ $related->judul_artikel }}</p>
                                        {{-- <small class="text-muted">Kesehatan • 5 menit</small> --}}
                                        <small class="text-muted">{{ $related->kategori }}</small>
                                    </div>
                                </a>
                            @empty
                                <p class="text-muted">Tidak ada artikel terkait.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 bg-white text-black">
        <div class="container text-center py-3">
            <p>© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>