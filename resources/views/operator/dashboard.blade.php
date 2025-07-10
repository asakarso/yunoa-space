@extends('layouts.app')

@section('content')
<style>
    .colors-ijo {
        color: #4fcfb1;
    }

    .colors-ijo-tua {
        color: #0f5a4a;
    }

    .kelola-btn {
        background-color: #4fcfb1;
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .kelola-btn:hover {
        background-color: #3bbfa2;
        color: white;
        transform: scale(1.02);
    }

    .stat-card {
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        transition: all 0.3s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-3px);
    }

    .bg-total {
        background-color: #e2e3e5;
    }

    .bg-draft {
        background-color: #fff3cd;
    }

    .bg-published {
        background-color: #d1e7dd;
    }

    .stat-card h6 {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: #0f5a4a;
    }

    .article-item a {
        text-decoration: none;
        color: #0f5a4a;
        transition: color 0.2s;
    }

    .article-item a:hover {
        color: #3bbfa2;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold colors-ijo-tua">Operator Dashboard</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
        <h5 class="mb-3 colors-ijo">
    <i class="bi bi-person-circle me-2"></i>Hello, <strong>{{ auth()->user()->nama_user}}</strong>!
</h5>
            <p class="text-muted mb-3">
                You are logged in as <span class="badge bg-success text-white">Operator</span>
            </p>
            <hr class="my-3">
            <p class="mb-2">Manage your articles via the menu below:</p>
            <a href="{{ route('operator.articles.index') }}" class="btn btn-success kelola-btn">
                <i class="bi bi-pencil-square me-1"></i>Manage Articles
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row">
        <div class="col-md-4">
            <div class="stat-card bg-total">
                <h6>Total Articles</h6>
                <p class="stat-value">{{ $total }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-draft">
                <h6>Draft</h6>
                <p class="stat-value">{{ $draft }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-published">
                <h6>Published</h6>
                <p class="stat-value">{{ $published }}</p>
            </div>
        </div>
    </div>

    {{-- Recently Published Articles --}}
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">
            <h5 class="colors-ijo mb-3">
                <i class="bi bi-journal-text me-2"></i>Recently Published Articles
            </h5>
            @forelse ($latestArticles->where('status', 'published') as $article)
                <div class="article-item mb-3">
                    <i class="bi bi-file-earmark-text-fill me-2 text-secondary"></i>
                    <a href="{{ route('operator.articles.preview', $article->id_review) }}" target="_blank">
                        {{ $article->judul_artikel }}
                    </a>
                    <br>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($article->tanggal_artikel)->format('d M Y') }}
                    </small>
                </div>
            @empty
                <p class="text-muted">No recently published articles.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
