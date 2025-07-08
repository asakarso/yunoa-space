@extends('layouts.app')

@section('content')
<style>
    /* Mengubah layout body agar form bisa di tengah */
    body, html {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #4fcfb1; 
    }

    /* Wadah utama form */
    .register-container {
        background-color: white;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 500px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 0.5rem;
    }

    .form-group .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        width: 100%;
    }

    .form-group .form-control:focus {
        border-color: #4fcfb1; /* Warna ijo tua saat fokus */
        box-shadow: none;
    }

    /* Styling untuk pilihan gender */
    .gender-option input[type="radio"] { display: none; }
    .gender-option .card-option {
        border: 2px solid #0f5a4a;
        border-radius: 0.75rem;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .gender-option .card-option:hover { border-color: #4fcfb1; }
    .gender-option input[type="radio"]:checked + .card-option {
        border-color: #4fcfb1;
        background-color: #d9faee;
        box-shadow: 0 0 0 2px #4fcfb1;
    }
    .gender-option img {
        width: 50px;
        height: 50px;
        margin-bottom: 0.5rem;
    }

    .btn-submit-custom {
      background-color: #4fcfb1;  /*Daftar */
      color: white;
      font-weight: bold;
      border-radius: 0.5rem;
      padding: 0.75rem;
      width: 100%;
      border: none;
    }
    .btn-submit-custom:hover { background-color: #0f5a4a; }
</style>

<div class="register-container">
    <h2 class="text-center mb-4 fw-bold">Buat Akun Yunoa</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nama_user">Nama Lengkap</label>
            <input id="nama_user" type="text" class="form-control" name="nama_user" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input id="tanggal_lahir" class="form-control" type="text" name="tanggal_lahir" placeholder="Pilih tanggal lahir" onfocus="(this.type='date')" onblur="(this.type='text')" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="row g-3 mt-1">
                <div class="col gender-option">
                    <label for="laki-laki">
                        <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-Laki" required>
                        <div class="card-option">
                            <img src="{{ asset('storage/kelamin/1.png') }}" alt="Laki-laki">
                            <span class="fw-bold">Laki-Laki</span>
                        </div>
                    </label>
                </div>
                <div class="col gender-option">
                    <label for="perempuan">
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                        <div class="card-option">
                            <img src="{{ asset('storage/kelamin/2.png') }}" alt="Perempuan">
                            <span class="fw-bold">Perempuan</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="nomor_telepon">Nomor Ponsel</label>
            <input id="nomor_telepon" type="text" class="form-control" name="nomor_telepon" placeholder="08123456789" required>
        </div>

        <div class="form-group">
            <label for="aktivitas_utama">Aktivitas Utama</label>
            <select id="aktivitas_utama" class="form-control" name="aktivitas_utama">
                <option value="" selected disabled>Pilih aktivitas utama Anda</option>
                <option value="Pelajar">Pelajar</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Pekerja Kantoran">Pekerja Kantoran</option>
                <option value="Pekerja Lapangan">Pekerja Lapangan</option>
                <option value="Wirausaha">Wirausaha</option>
                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tujuan_menggunakan">Tujuan Menggunakan Aplikasi</label>
            <input id="tujuan_menggunakan" type="text" class="form-control" name="tujuan_menggunakan" placeholder="Misal: Mencari informasi kesehatan mental">
        </div>

        <div class="form-group">
            <label for="jam_tidur">Perkiraan Jam Tidur</label>
            <input id="jam_tidur" type="time" class="form-control" name="jam_tidur">
        </div>

        <div class="form-group">
            <label for="email_user">Email</label>
            <input id="email_user" type="email" class="form-control" name="email_user" placeholder="Masukkan email" required>
        </div>

        <div class="form-group">
            <label for="pass_user">Password</label>
            <input id="pass_user" type="password" class="form-control" name="pass_user" placeholder="Buat password" required>
        </div>
        
        <div class="form-group">
            <label for="pass_user_confirmation">Konfirmasi Password</label>
            <input id="pass_user_confirmation" class="form-control" type="password" name="pass_user_confirmation" placeholder="Ulangi password" required>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-submit-custom">Daftar</button>
        </div>
    </form>
</div>
@endsection