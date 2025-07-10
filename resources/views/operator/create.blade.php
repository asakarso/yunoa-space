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

        {{-- Date and Time fields have been REMOVED --}}

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

        {{-- Status dropdown has been REMOVED --}}

        {{-- NEW Action Buttons --}}
        <div class="mt-4 border-top pt-4">
            {{-- Tombol "Publish" mengirimkan status 'published' --}}
            <button type="submit" name="status" value="published" class="btn btn-success submit-btn">
                <i class="bi bi-check-circle"></i> Publish
            </button>

            {{-- Tombol "Save as Draft" mengirimkan status 'draft' --}}
            <button type="submit" name="status" value="draft" class="btn btn-primary submit-btn">
                <i class="bi bi-save"></i> Save as Draft
            </button>

            {{-- Tombol Cancel hanya link biasa, bukan bagian dari form --}}
            <a href="{{ route('operator.articles.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Menargetkan form dengan ID 'article-form'
    const form = document.getElementById('article-form');

    // Menargetkan semua tombol submit di dalam form
    const submitButtons = form.querySelectorAll('.submit-btn');

    // Menambahkan event listener ke form saat disubmit
    form.addEventListener('submit', function() {
        // Loop melalui semua tombol submit
        submitButtons.forEach(button => {
            // Menonaktifkan tombol untuk mencegah klik ganda
            button.disabled = true;
            // Menambahkan spinner ke tombol yang diklik
            if (document.activeElement === button) {
                button.innerHTML = `
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Saving...
                `;
            }
        });
    });
</script>
@endpush