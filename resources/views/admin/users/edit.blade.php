@extends('layouts.admin')

@section('content')
<h1 class="h2">Edit User: {{ $user->nama_user }}</h1>
<p>Update user details and permissions.</p>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_user" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" required>
                @error('nama_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="email_user" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email_user') is-invalid @enderror" id="email_user" name="email_user" value="{{ old('email_user', $user->email_user) }}" required>
                 @error('email_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                    <option value="" disabled>Select a role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id_role }}" {{ $user->roles->contains($role->id_role) ? 'selected' : '' }}>
                            {{ ucfirst($role->nama_role) }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr class="my-4">
            <p class="text-muted">Leave password fields blank if you don't want to change the password.</p>
            
            <div class="mb-3">
                <label for="pass_user" class="form-label">New Password</label>
                <input type="password" class="form-control @error('pass_user') is-invalid @enderror" id="pass_user" name="pass_user">
                @error('pass_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="pass_user_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="pass_user_confirmation" name="pass_user_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection