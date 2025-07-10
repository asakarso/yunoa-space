<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation - Yunoa Space</title>
    @vite(['resources/css/app.css', 'resources/css/consultation.css'])
</head>
<body>
    <x-navbar></x-navbar>

    <div class="container mt-5">
        <div class="consultation-header text-center mb-5">
            <h1 class="fw-bold">Meet Our Professionals</h1>
            <p class="lead text-secondary">Find the right expert to guide you on your mental wellness journey.</p>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form action="{{ route('consultation') }}" method="GET" class="d-flex">
                    <input class="form-control form-control-lg me-2" type="search" name="search" placeholder="Search for a doctor by name..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-search" type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($doctors as $doctor)
                @if ($doctor->doctor)
                <div class="col-md-6 col-lg-4">
                    <div class="card doctor-card h-100">
                        <img src="{{ $doctor->foto_profil ? asset('storage/' . $doctor->foto_profil) : asset('images/default-profile.png') }}" class="card-img-top" alt="{{ $doctor->nama_user }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $doctor->nama_user }}</h5>
                            
                            <p class="card-text text-success fw-semibold">{{ $doctor->doctor->specialization ?? 'Professional Psychologist' }}</p>
                            
                            <div class="mt-auto pt-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>{{ $doctor->doctor->schedule ?? 'Not specified' }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <i class="bi bi-tags-fill"></i>
                                    <span>Rp{{ number_format($doctor->doctor->consultation_price ?? 0, 0, ',', '.') }} / session</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="{{ route('doctors.show', $doctor->id_user) }}" class="btn btn-outline-success">View Details</a>
                                    <a href="{{ route('counseling.payment', ['doctor_id' => $doctor->id_user]) }}" class="btn btn-primary-yunoa">Start Consultation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div class="col">
                    <div class="alert alert-warning text-center">
                        <p class="mb-0">No doctors found matching your search criteria.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>