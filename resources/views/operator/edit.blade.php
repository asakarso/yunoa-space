@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Article</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('operator.articles.update', $article->id_review) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul_artikel" class="form-label">Article Title</label>
            <input type="text" name="judul_artikel" class="form-control" value="{{ old('judul_artikel', $article->judul_artikel) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_artikel" class="form-label">Date</label>
            <input type="date" name="tanggal_artikel" class="form-control" value="{{ old('tanggal_artikel', $article->tanggal_artikel) }}" required>
        </div>

        <div class="mb-3">
            <label for="waktu_artikel" class="form-label">Time</label>
            <input type="time" name="waktu_artikel" class="form-control" value="{{ old('waktu_artikel', $article->waktu_artikel) }}" required>
        </div>

        <div class="mb-3">
            <label for="konten_artikel" class="form-label">Article Content</label>
            <textarea name="konten_artikel" class="form-control" rows="5" required>{{ old('konten_artikel', $article->konten_artikel) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar_cover" class="form-label">Cover Image</label><br>
            @if($article->gambar_cover)
                <img src="{{ asset('storage/article_covers/' . $article->gambar_cover) }}" alt="Cover" width="150" class="mb-2"><br>
            @endif
            <input type="file" name="gambar_cover" class="form-control">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Article</button>
        <a href="{{ route('operator.articles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection