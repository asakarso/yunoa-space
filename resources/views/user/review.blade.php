<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF--8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Form | Yunoa Space</title>
    
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --yunoa-green: #6BB99F;
            --yunoa-light-green: #e6f3ef;
            --yunoa-yellow: #ffc107;
        }
        body {
            background-color: #f8f9fa;
        }
        main { 
            min-height: calc(100vh - 120px);
        }
        .review-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 2.5rem;
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
        .list-header {
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 2rem;
        }
        .list-header h2 .colors-ijo-tua {
            color: var(--yunoa-green);
        }
        .doctor-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .doctor-info img {
            width: 70px; 
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
        }
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            font-size: 2.5rem;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: var(--yunoa-yellow);
        }
        .display-stars {
            font-size: 2rem;
            color: #ddd;
        }
        .display-stars .text-yellow {
            color: var(--yunoa-yellow);
        }
        .review-text-display {
            background-color: #f8f9fa;
            border-left: 4px solid var(--yunoa-green);
            padding: 1rem 1.5rem;
            border-radius: 4px;
        }
        .btn-yunoa-green {
            background-color: var(--yunoa-green);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border: none;
            transition: background-color 0.2s ease;
        }
        .btn-yunoa-green:hover {
            background-color: #5aa88f;
            color: white;
        }
    </style>
</head>
<body>
    <x-navbar />

    <main class="py-5">
        <div class="container">
            <div class="review-container shadow-lg">
                <div class="flex gap-3">
                    <a href="{{ route('chat', $konsultasi->id_konsul) }}" class="text-dark">
                        <i class="bi bi-arrow-left fs-2"></i>
                    </a>
                    <div class="list-header">
                        <h2 class="fw-bold mb-1">Session <span class="colors-ijo-tua">Review</span></h2>
                        <p class="text-muted mb-0">Your feedback helps us and others. Thank you for your time!</p>
                    </div>
                </div>

                <div class="doctor-info">
                    <img src="{{ asset('storage/' . $dokter->foto_profil) }}" alt="Profile Picture">
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $dokter->nama_user }}</h4>
                        <p class="mb-0 text-muted">Review for your session on {{ $konsultasi->created_at->format('F d, Y') }}</p>
                    </div>
                </div>

                @if ($review === null || ($isEdit ?? false))
                    <form method="POST" action="{{ ($isEdit ?? false) ? route('review.update', $review->id_review) : route('review.store', $konsultasi->id_konsul) }}">
                        @csrf
                        @if (($isEdit ?? false))
                            @method('PUT')
                        @endif
                        
                        <div class="mb-4 text-center">
                            <input type="hidden" name="dokterId" value="{{ $dokter->id_user }}"/>
                            <label class="form-label fw-semibold fs-5 d-block mb-3">How would you rate your session?</label>
                            <div class="star-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                <input 
                                    type="radio" 
                                    id="star{{ $i }}" 
                                    name="rating" 
                                    value="{{ $i }}" 
                                    {{ old('rating', optional($review)->rating) == $i ? 'checked' : '' }} 
                                    required
                                />
                                <label for="star{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">★</label>
                                @endfor
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="review_text" class="form-label fw-semibold">Share your experience</label>
                            <textarea name="deskripsi_review" id="review_text" rows="5" class="form-control" placeholder="What did you like? What could be improved?" required>{{ old('deskripsi_review', optional($review)->deskripsi_review) }}</textarea>
                        </div>

                        <hr class="my-4">

                        <button type="submit" class="btn btn-yunoa-green w-100">
                            <i class="bi bi-send-fill me-2"></i>
                            {{ ($isEdit ?? false) ? 'Update Review' : 'Submit Review' }}
                        </button>
                    </form>
                @else     
                    <div class="text-center">
                        <label class="form-label fw-semibold fs-5 d-block mb-3">Your Submitted Rating</label>
                        <div class="display-stars mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $review->rating ? 'text-yellow' : '' }}">★</span>
                            @endfor
                        </div>

                        <div class="mb-4 text-start">
                            <label class="form-label fw-semibold">Your feedback:</label>
                            <div class="review-text-display">
                                <p class="m-0 fst-italic">"{{ $review->deskripsi_review }}"</p>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <a href="{{ route('review.edit', $review->id_konsul) }}?isEdit=true" class="btn btn-yunoa-outline">
                                <i class="bi bi-pencil-square me-2"></i>Edit Review
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-white">
        <div class="container text-center py-1">
            <p class="m-0">© 2025 Yunoa Space. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>