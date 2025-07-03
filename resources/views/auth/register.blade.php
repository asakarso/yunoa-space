@extends('layouts.app')

@section('content')
<style>
    :root {
      --primary-green: #6BB99F;
      --dark-green: #0F5A4A;
      --light-gray-border: #d4d4d4;
      --dark-text: #1e1e1e;
    }

    .form-container-custom {
      font-family: 'Poppins', sans-serif;
      color: var(--dark-text);
    }
    
    .form-title .colors-ijo {
      color: var(--primary-green);
      font-weight: 600;
    }
    
    /* Styling untuk Input dan Label */
    .form-container-custom label {
      font-weight: bold;
      color: var(--dark-text);
      display: block;
      margin-bottom: 4px;
    }

    .form-container-custom input[type="text"],
    .form-container-custom input[type="email"],
    .form-container-custom input[type="password"] {
      margin-bottom: 8px;
      border: 1px solid var(--light-gray-border);
      border-radius: 4px;
      padding: 10px 16px;
      width: 100%;
    }

    .form-container-custom input:focus {
      outline: none;
      border: 2px solid var(--primary-green);
    }
    
    /* Styling untuk Tombol Submit */
    .btn-submit-custom {
      background-color: var(--primary-green);
      color: white;
      font-weight: bold;
      border-radius: 4px;
      padding: 10px;
      width: 100%;
      border: none;
      transition: background-color 0.2s ease-in-out;
    }

    .btn-submit-custom:hover {
      background-color: rgb(54, 146, 115);
    }

    .btn-submit-custom:active {
      background-color: var(--dark-green);
    }

    /* Styling untuk pesan error validasi */
    .validation-error {
        color: red;
        font-size: 0.875em;
        display: block;
        margin-bottom: 1rem;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-6 form-container-custom">
        <h1 class="text-center my-4 form-title">Register to <span class="colors-ijo">Join Our Space</span></h1><br>

        <form method="POST" action="{{ route('register') }}" class="mb-5">
            @csrf

            
            <div class="mb-2">
                <label for="nama_user">Nama Lengkap</label>
                <input id="nama_user" type="text" name="nama_user" value="{{ old('nama_user') }}" placeholder="Masukkan nama lengkap anda" required>
                @error('nama_user')
                    <small class="validation-error">{{ $message }}</small>
                @enderror
            </div>

          
            <div class="mb-2">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input id="nomor_telepon" type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Masukkan nomor telepon anda" required>
                @error('nomor_telepon')
                    <small class="validation-error">{{ $message }}</small>
                @enderror
            </div>

            
            <div class="mb-2">
                <label for="email_user">Email</label>
                <input id="email_user" type="email" name="email_user" value="{{ old('email_user') }}" placeholder="Masukkan email anda" required>
                @error('email_user')
                    <small class="validation-error">{{ $message }}</small>
                @enderror
            </div>

           
            <div class="mb-2">
                <label for="pass_user">Password</label>
                <input id="pass_user" type="password" name="pass_user" placeholder="Masukkan password anda" required>
                @error('pass_user')
                    <small class="validation-error">{{ $message }}</small>
                @enderror
            </div>

            
            <div class="mb-2">
                <label for="pass_user_confirmation">Konfirmasi Password</label>
                <input id="pass_user_confirmation" type="password" name="pass_user_confirmation" placeholder="Masukkan ulang password anda" required>
            </div>

           
            <div class="mt-4">
                <button type="submit" class="btn-submit-custom">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection