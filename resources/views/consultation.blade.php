<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation - Yunoa Space</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/css/components/navbar.css', 'resources/css/consultation.css'])
</head>
<body>
    <x-navbar></x-navbar>

    <div class="container mt-5">
        <div class="consultation-header text-center mb-5">
            <h1 class="fw-bold">Meet Our Professionals</h1>
            <p class="lead text-secondary">Find the right expert to guide you on your mental wellness journey.</p>
        </div>

        {{-- Search Bar --}}
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form action="{{ route('consultation') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search for a doctor by name..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-search" type="submit">Search</button>
                </form>
            </div>
        </div>

        {{-- Doctors List --}}
        <div class="row g-4">
            @forelse ($doctors as $doctor)
                <div class="col-md-6 col-lg-4">
                    <div class="card doctor-card h-100">
                        {{-- Use placeholder if no photo is available --}}
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('images/default-profile.png') }}" class="card-img-top" alt="Dr. {{ $doctor->nama_user }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $doctor->nama_user }}</h5>
                            <p class="card-text text-success fw-semibold">{{ $doctor->specialization }}</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>{{ $doctor->schedule ?? 'Not specified' }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <i class="bi bi-tags-fill"></i>
                                    <span>Rp{{ number_format($doctor->consultation_price, 0, ',', '.') }} / session</span>
                                </div>

                                {{-- The button now correctly links to the payment route --}}
                                <a href="{{ route('counseling.payment', ['doctor_id' => $doctor->id_user]) }}" class="btn btn-primary-yunoa w-100">Start Consultation</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-warning text-center">
                        <p class="mb-0">No doctors found matching your search criteria.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>