@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Main Title --}}
    <h2 class="mb-4">Add New Article</h2>

    {{-- Error Display --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- The Form --}}
    <form id="article-form" action="{{ route('operator.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Article Title --}}
        <div class="mb-3">
            <label for="judul_artikel" class="form-label">Article Title</label>
            <input type="text" name="judul_artikel" class="form-control" value="{{ old('judul_artikel') }}" required>
        </div>

        {{-- Date and Time side-by-side --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tanggal_artikel" class="form-label">Date</label>
                <input type="date" name="tanggal_artikel" class="form-control" value="{{ old('tanggal_artikel') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="waktu_artikel" class="form-label">Time</label>
                <input type="time" name="waktu_artikel" class="form-control" value="{{ old('waktu_artikel') }}" required>
            </div>
        </div>

        {{-- Article Content --}}
        <div class="mb-3">
            <label for="konten_artikel" class="form-label">Article Content</label>
            <textarea name="konten_artikel" class="form-control" rows="5" required>{{ old('konten_artikel') }}</textarea>
        </div>

        {{-- Cover Image --}}
        <div class="mb-3">
            <label for="gambar_cover" class="form-label">Cover Image</label>
            <input type="file" name="gambar_cover" class="form-control">
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-4">
            <button id="submit-button" type="submit" class="btn btn-success">
                <i ></i> Save Article
            </button>
            <a href="{{ route('operator.articles.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Targets the form with the ID 'article-form'
    const form = document.getElementById('article-form');

    // Targets the submit button with the ID 'submit-button'
    const submitButton = document.getElementById('submit-button');

    // Adds an event listener to the form for the 'submit' event
    form.addEventListener('submit', function() {
        // Disables the button to prevent multiple clicks
        submitButton.disabled = true;

        // Changes the button's text to provide user feedback
        submitButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Saving...
        `;
    });
</script>
@endpush