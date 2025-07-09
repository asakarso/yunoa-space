@extends('layouts.admin')

@section('content')
<h1 class="h2">Dashboard</h1>
<p>Welcome to the Yunoa Space Admin Panel, {{ auth()->user()->nama_user }}!</p>

<div class="row mt-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-people-fill fs-1"></i>
                    <div class="text-end">
                        <h3 class="card-title fw-bold">{{ $stats['total_users'] }}</h3>
                        <p class="card-text">Total Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                 <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-heart-pulse-fill fs-1"></i>
                    <div class="text-end">
                        <h3 class="card-title fw-bold">{{ $stats['total_doctors'] }}</h3>
                        <p class="card-text">Verified Doctors</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-secondary h-100">
            <div class="card-body">
                 <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-person-check-fill fs-1"></i>
                    <div class="text-end">
                        <h3 class="card-title fw-bold">{{ $stats['total_pengguna'] }}</h3>
                        <p class="card-text">Regular Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-danger h-100">
            <div class="card-body">
                 <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-person-gear fs-1"></i>
                    <div class="text-end">
                        <h3 class="card-title fw-bold">{{ $stats['total_admins'] }}</h3>
                        <p class="card-text">Admins</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-info h-100">
            <div class="card-body">
                 <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-person-workspace fs-1"></i>
                    <div class="text-end">
                        <h3 class="card-title fw-bold">{{ $stats['total_operators'] }}</h3>
                        <p class="card-text">Operators</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-dark bg-warning h-100">
            <div class="card-body">
                 <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-hourglass-split fs-1"></i>
                    <div class="text-end">
                        <h3 class="card-title fw-bold">{{ $stats['pending_doctors'] }}</h3>
                        <p class="card-text">Pending Doctors</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.doctors.verification') }}" class="card-footer text-dark text-decoration-none d-flex justify-content-between align-items-center">
                <span>View Details</span>
                <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>
</div>
@endsection