@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Selamat datang, {{ auth()->user()->name }} (Admin)</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
<div class="card mb-4">
    <div class="card-header">
        Menu Navigasi Admin
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            {{-- ... menu admin lainnya mungkin ada di sini ... --}}
            
            {{-- INI LINK BARUNYA --}}
            <li class="list-group-item">
                <a href="{{ route('admin.payments.index') }}">
                    Verifikasi Pembayaran Konsultasi
                </a>
            </li>

            {{-- ... menu admin lainnya mungkin ada di sini ... --}}
        </ul>
    </div>
</div>
@endsection
