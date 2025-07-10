@extends('layouts.app')

@section('content')
<style>
    body, html {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding: 1rem 0;
        background-color: #e8f5f1;
    }
    .register-container {
        background-color: white;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        width: 90%;
        min-width: 800px; 
    }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label {
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 0.5rem;
    }
    .form-group .form-control, .form-group .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        width: 100%;
    }
    .gender-option input[type="radio"] { display: none; }
    .gender-option .card-option {
        border: 2px solid #e0e0e0;
        border-radius: 0.75rem;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .gender-option input[type="radio"]:checked + .card-option {
        border-color: #4fcfb1;
        background-color: #d9faee;
    }
    .gender-option img {
        width: 40px;
        height: 40px;
        margin-bottom: 0.5rem;
    }
    .btn-submit-custom {
      background-color: #4fcfb1;
      color: white;
      font-weight: bold;
      border-radius: 0.5rem;
      padding: 0.85rem;
      width: 100%;
      border: none;
    }
    .btn-submit-custom:hover { background-color: #0f5a4a; }
</style>

<div class="register-container">
    <h2 class="text-center mb-4 fw-bold colors-ijo-tua">Create Your Account</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="form-group">
            <label for="nama_user">Full Name</label>
            <input id="nama_user" type="text" class="form-control" name="nama_user" placeholder="Enter your full name" value="{{ old('nama_user') }}" required>
        </div>
        
        <div class="form-group">
            <label for="tanggal_lahir">Date of Birth</label>
            <input id="tanggal_lahir" class="form-control" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="row g-3 mt-1">
                <div class="col gender-option">
                    <label for="laki-laki">
                        <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' }} required>
                        <div class="card-option">
                            <img src="{{ asset('storage/kelamin/1.png') }}" alt="Male">
                            <span class="fw-bold">Male</span>
                        </div>
                    </label>
                </div>
                <div class="col gender-option">
                    <label for="perempuan">
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                        <div class="card-option">
                            <img src="{{ asset('storage/kelamin/2.png') }}" alt="Female">
                            <span class="fw-bold">Female</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="nomor_telepon">Phone Number</label>
            <input id="nomor_telepon" type="tel" class="form-control" name="nomor_telepon" placeholder="e.g., 08123456789" value="{{ old('nomor_telepon') }}" required>
        </div>

        <div class="form-group">
            <label for="email_user">Email Address</label>
            <input id="email_user" type="email" class="form-control" name="email_user" placeholder="Enter your email" value="{{ old('email_user') }}" required>
        </div>

        <div class="form-group">
            <label for="pass_user">Password</label>
            <input id="pass_user" type="password" class="form-control" name="pass_user" placeholder="Create a password (min. 8 characters)" required>
        </div>
        
        <div class="form-group">
            <label for="pass_user_confirmation">Confirm Password</label>
            <input id="pass_user_confirmation" class="form-control" type="password" name="pass_user_confirmation" placeholder="Repeat your password" required>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-submit-custom">Register</button>
        </div>
        
        <p class="text-center text-muted mt-3 mb-0">
            Already have an account? <a href="{{ route('login') }}" class="colors-ijo-tua fw-bold">Login here</a>.
            <br>
            Are you a professional? <a href="{{ route('register.doctor') }}" class="colors-ijo-tua fw-bold">Register as a Doctor</a>.
        </p>
    </form>
</div>
@endsection