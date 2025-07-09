@extends('layouts.admin')

@section('content')
<h1 class="h2">Add New Administrator</h1>
<p>Create a new account for an Admin or Operator.</p>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_user" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" name="nama_user" value="{{ old('nama_user') }}" required>
                @error('nama_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="email_user" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email_user') is-invalid @enderror" id="email_user" name="email_user" value="{{ old('email_user') }}" required>
                 @error('email_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                    <option value="" disabled selected>Select a role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id_role }}">{{ ucfirst($role->nama_role) }}</option>
                    @endforeach
                </select>
                @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="pass_user" class="form-label">Password</label>
                <input type="password" class="form-control @error('pass_user') is-invalid @enderror" id="pass_user" name="pass_user" required>
                @error('pass_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="pass_user_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="pass_user_confirmation" name="pass_user_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection