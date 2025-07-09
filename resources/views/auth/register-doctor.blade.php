@extends('layouts.app')

@section('content')
<style>
    body, html {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem 0;
        background-color: #e8f5f1;
    }
    .register-container {
        background-color: white;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 700px;
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
    <h2 class="text-center mb-2 fw-bold colors-ijo-tua">Doctor Registration</h2>
    <p class="text-center text-muted mb-4">Join our team of professionals. Your account will be active after admin verification.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.doctor.submit') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_user">Full Name (with titles)</label>
            <input id="nama_user" type="text" class="form-control" name="nama_user" placeholder="e.g., Dr. John Doe, M.Psi." value="{{ old('nama_user') }}" required>
        </div>
        <div class="form-group">
            <label for="email_user">Email Address</label>
            <input id="email_user" type="email" class="form-control" name="email_user" placeholder="Enter your email" value="{{ old('email_user') }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Date of Birth</label>
            <input id="tanggal_lahir" class="form-control" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Gender</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                <option value="" disabled selected>Select gender</option>
                <option value="Laki-Laki" @if(old('jenis_kelamin') == 'Laki-Laki') selected @endif>Male</option>
                <option value="Perempuan" @if(old('jenis_kelamin') == 'Perempuan') selected @endif>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Phone Number</label>
            <input id="nomor_telepon" type="tel" class="form-control" name="nomor_telepon" placeholder="Active phone number" value="{{ old('nomor_telepon') }}" required>
        </div>
        <hr class="my-4">
        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input id="specialization" type="text" class="form-control" name="specialization" placeholder="e.g., Clinical Psychologist" value="{{ old('specialization') }}" required>
        </div>
         <div class="form-group">
            <label for="consultation_price">Consultation Price (per session)</label>
            <input id="consultation_price" type="number" class="form-control" name="consultation_price" placeholder="e.g., 250000" value="{{ old('consultation_price') }}" required>
        </div>
        <div class="form-group">
            <label for="education">Education (University, Degree, Year)</label>
            <textarea id="education" name="education" class="form-control" rows="3" placeholder="e.g., University of Indonesia, Master of Psychology, 2018">{{ old('education') }}</textarea>
        </div>
        <div class="form-group">
            <label for="schedule">Weekly Schedule</label>
            <input id="schedule" type="text" class="form-control" name="schedule" placeholder="e.g., Mon, Wed, Fri (09:00 - 15:00)" value="{{ old('schedule') }}" required>
        </div>
        <div class="form-group">
            <label for="foto_profil">Profile Photo</label>
            <input id="foto_profil" type="file" class="form-control" name="foto_profil" required>
        </div>
        <div class="form-group">
            <label for="str_sip_file">STR/SIP Document (PDF/Image)</label>
            <input id="str_sip_file" type="file" class="form-control" name="str_sip_file" required>
        </div>
        <hr class="my-4">
        <div class="form-group">
            <label for="pass_user">Password</label>
            <input id="pass_user" type="password" class="form-control" name="pass_user" placeholder="Minimum 8 characters" required>
        </div>
        <div class="form-group">
            <label for="pass_user_confirmation">Confirm Password</label>
            <input id="pass_user_confirmation" class="form-control" type="password" name="pass_user_confirmation" placeholder="Repeat password" required>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn-submit-custom">Register</button>
        </div>
         <p class="text-center text-muted mt-3 mb-0">
            Already have an account? <a href="{{ route('login') }}" class="colors-ijo-tua fw-bold">Login here</a>.
        </p>
    </form>
</div>
@endsection