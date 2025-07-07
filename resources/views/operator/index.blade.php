@extends('layouts.app')

@section('content')
{{-- Custom Styles for the theme --}}
<style>
    .text-theme-dark-green {
        color: #0f5a4a;
    }
    .btn-theme-green {
        background-color: #4fcfb1;
        color: white;
        border: none;
    }
    .btn-theme-green:hover {
        background-color: #42b89a; /* A slightly darker shade for hover */
        color: white;
    }
    .card-header {
        border-bottom: 1px solid #e9ecef;
    }
</style>

<div class="container py-4">

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        {{-- Card Header: Title and Add Button --}}
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0 text-theme-dark-green">
                    <i class="bi bi-journal-text me-2"></i>
                    Article List
                </h2>
                <a href="{{ route('operator.articles.create') }}" class="btn btn-theme-green">
                    <i class="bi bi-plus-circle me-1"></i> Add New Article
                </a>
            </div>
        </div>

        {{-- Card Body with Table --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-3">Title</th>
                            <th class="py-3 px-3">Date</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Created On</th>
                            <th class="text-center py-3 px-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td class="px-3">{{ $article->judul_artikel }}</td>
                                <td class="px-3">{{ \Carbon\Carbon::parse($article->tanggal_artikel)->format('d M Y') }}</td>
                                <td class="px-3">
                                    <span class="badge rounded-pill bg-{{ $article->status === 'published' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td class="px-3">{{ $article->created_at->format('d M Y') }}</td>
                                <td class="text-center px-3">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('operator.articles.preview', $article->id_review) }}" class="btn btn-sm btn-outline-secondary" title="Preview">
                                            <i class="bi bi-eye"></i> Preview
                                        </a>
                                        <a href="{{ route('operator.articles.edit', $article->id_review) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('operator.articles.destroy', $article->id_review) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-folder2-open fs-3 d-block mb-2"></i>
                                    No articles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection