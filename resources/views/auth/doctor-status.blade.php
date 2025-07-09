@extends('layouts.app')

@section('content')
<style>
    body, html {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #e8f5f1;
    }
    .status-container {
        background-color: white;
        padding: 3rem;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 600px;
        text-align: center;
    }
    .status-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
    }
    .icon-pending { color: #fd7e14; }
    .icon-success { color: #198754; }
</style>

<div class="status-container">
    @if ($doctor->doctor && $doctor->doctor->verified_at)
        {{-- Status: Disetujui --}}
        <i class="bi bi-check-circle-fill status-icon icon-success"></i>
        <h2 class="fw-bold">Registration Approved!</h2>
        <p class="text-muted">Congratulations, {{ $doctor->nama_user }}! Your account has been verified. You can now log in to access your dashboard.</p>
    
    @else
        {{-- Status: Menunggu --}}
        <i class="bi bi-hourglass-split status-icon icon-pending"></i>
        <h2 class="fw-bold">Application Submitted</h2>
        <p class="text-muted">Thank you, {{ $doctor->nama_user }}. Your application is under review. The verification process may take up to 1x24 hours. Please try to log in again later.</p>
    @endif

    <a href="{{ route('login') }}" class="btn btn-primary mt-4 px-5">Go to Login</a>
</div>
@endsection