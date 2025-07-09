@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">Review Doctor: {{ $doctor->nama_user }}</h1>
    <a href="{{ route('admin.doctors.verification') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Verification List
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header fw-bold">Doctor Details</div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $doctor->nama_user }}</dd>

                    <dt class="col-sm-3">Date of Birth</dt>
                    <dd class="col-sm-9">{{ $doctor->profile ? \Carbon\Carbon::parse($doctor->profile->tanggal_lahir)->format('d F Y') : 'N/A' }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $doctor->email_user }}</dd>

                    <dt class="col-sm-3">Phone</dt>
                    <dd class="col-sm-9">{{ $doctor->nomor_telepon }}</dd>
                    
                    <hr class="my-2">
                    
                    <dt class="col-sm-3">Specialization</dt>
                    <dd class="col-sm-9">{{ $doctor->doctor->specialization }}</dd>

                    <dt class="col-sm-3">Education</dt>
                    <dd class="col-sm-9">{{ $doctor->doctor->education }}</dd>

                    <dt class="col-sm-3">Schedule</dt>
                    <dd class="col-sm-9">{{ $doctor->doctor->schedule }}</dd>

                    <dt class="col-sm-3">Price</dt>
                    <dd class="col-sm-9">Rp{{ number_format($doctor->doctor->consultation_price, 0, ',', '.') }}</dd>
                    
                    <hr class="my-2">
                    
                    <dt class="col-sm-3">STR/SIP Document</dt>
                    <dd class="col-sm-9">
                        <a href="{{ asset('storage/' . $doctor->doctor->str_sip_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark-text"></i> View Document
                        </a>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header fw-bold">Profile Photo</div>
            <div class="card-body text-center">
                 <img src="{{ asset('storage/' . $doctor->foto_profil) }}" alt="Profile Photo" class="img-fluid rounded" style="max-height: 250px;">
            </div>
        </div>
        <div class="card">
             <div class="card-header fw-bold">Actions</div>
             <div class="card-body">
                 <p class="small">Approve the registration or reject to delete it permanently.</p>
                 <form action="{{ route('admin.doctors.verify', $doctor) }}" method="POST" class="d-grid mb-2">
                     @csrf
                     <button type="submit" class="btn btn-success"><i class="bi bi-check-circle-fill me-2"></i>Approve & Verify</button>
                 </form>
                 <form action="{{ route('admin.doctors.reject', $doctor) }}" method="POST" class="d-grid" onsubmit="return confirm('Are you sure you want to REJECT and DELETE this registration? This action cannot be undone.');">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger"><i class="bi bi-x-circle-fill me-2"></i>Reject & Delete</button>
                 </form>
             </div>
        </div>
    </div>
</div>
@endsection