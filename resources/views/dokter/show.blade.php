@extends('layouts.app')

@section('content')
<style>
    .doctor-profile-card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden; 
    }
    .profile-header {
        background: linear-gradient(135deg, #6BB99F 0%, #0F5A4A 100%);
        color: white;
        padding: 2rem;
        height: 150px;
    }
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        margin-top: -75px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .info-section h5 {
        color: #0F5A4A;
        font-weight: bold;
        border-bottom: 2px solid #eaf0ef;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }
    .info-item {
        font-size: 1.05rem;
        margin-bottom: 0.75rem;
    }
    .info-item .icon {
        color: #6BB99F;
        font-size: 1.2rem;
        width: 30px;
    }
</style>

<div class="container my-5">
    <div class="card doctor-profile-card">
        <div class="profile-header"></div>
        <div class="card-body text-center px-4 pb-4">
            <img src="{{ $doctor->foto_profil ? asset('storage/' . $doctor->foto_profil) : asset('images/default-profile.png') }}" alt="Dr. {{ $doctor->nama_user }}" class="profile-avatar">
            <h2 class="fw-bold mt-3 mb-1">{{ $doctor->nama_user }}</h2>
            <p class="text-success fw-semibold fs-5">{{ $doctor->doctor->specialization }}</p>
            <p class="text-muted"><i class="bi bi-telephone-fill"></i> {{ $doctor->nomor_telepon }}</p>

            <a href="{{ route('counseling.payment', ['doctor_id' => $doctor->id_user]) }}" class="btn btn-primary-yunoa btn-lg mt-3 px-5">
                Start Consultation - Rp{{ number_format($doctor->doctor->consultation_price, 0, ',', '.') }}
            </a>
        </div>
        <hr class="my-0">
        <div class="card-body p-4 p-md-5">
            <div class="info-section">
                <h5><i class="bi bi-mortarboard-fill me-2"></i>Education & Background</h5>
                <p class="mb-0">{{ $doctor->doctor->education ?: 'Not specified' }}</p>
            </div>
            <hr class="my-4">
             <div class="info-section">
                <h5><i class="bi bi-clock-history me-2"></i>Schedule & Price</h5>
                <div class="info-item d-flex">
                    <i class="bi bi-calendar-week icon"></i>
                    <p class="mb-0 ms-2"><strong>Schedule:</strong> {{ $doctor->doctor->schedule ?: 'Not specified' }}</p>
                </div>
                <div class="info-item d-flex">
                    <i class="bi bi-tags icon"></i>
                    <p class="mb-0 ms-2"><strong>Price:</strong> Rp{{ number_format($doctor->doctor->consultation_price, 0, ',', '.') }} / session</p>
                </div>
            </div>
             <div class="text-center mt-5">
                 <a href="{{ route('consultation') }}" class="btn btn-outline-secondary">
                     <i class="bi bi-arrow-left"></i> Back to Doctor List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection