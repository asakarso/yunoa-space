@extends('layouts.admin')

@section('content')
<h1 class="h2">Doctor Verification</h1>
<p>Review and approve or reject new doctor registrations.</p>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Registered On</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingDoctors as $doctor)
                        <tr>
                            <td>{{ $doctor->nama_user }}</td>
                            <td>{{ $doctor->email_user }}</td>
                            <td>{{ $doctor->doctor->specialization }}</td>
                            <td>{{ $doctor->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No pending verifications.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pendingDoctors->links() }}
        </div>
    </div>
</div>
@endsection