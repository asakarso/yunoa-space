@extends('layouts.app')

@section('content')
<style>
    .colors-ijo {
        color: #4fcfb1;
    }

    .colors-ijo-tua {
        color: #0f5a4a;
    }

    .btn-kembali {
        background-color: #4fcfb1;
        color: white;
        border: none;
    }

    .btn-kembali:hover {
        background-color: #3bbfa2;
    }

    .artikel-cover {
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .artikel-body {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #333;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-1 colors-ijo-tua">{{ $article->judul_artikel }}</h2>
    <p class="text-muted mb-4">{{ $article->tanggal_artikel }} | {{ $article->waktu_artikel }}</p>

    @if ($article->gambar_cover)
        <img src="{{ asset('storage/article_covers/' . $article->gambar_cover) }}" alt="Gambar Artikel" class="img-fluid artikel-cover">
    @endif

    <div class="artikel-body">
        {!! nl2br(e($article->konten_artikel)) !!}
    </div>

    <a href="{{ route('operator.articles.index') }}" class="btn btn-kembali mt-4">
        <i class="bi bi-arrow-left"></i> Back to Article List
    </a>
</div>
@endsection
