@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User Management</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success">
            <i class="bi bi-plus-circle"></i> Add Administrator
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.users.index') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                <select name="role" class="form-select" style="max-width: 200px;">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->nama_role }}" {{ request('role') == $role->nama_role ? 'selected' : '' }}>
                            {{ ucfirst($role->nama_role) }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm align-middle">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role(s)</th>
                        <th scope="col">Joined At</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id_user }}</td>
                        <td>{{ $user->nama_user }}</td>
                        <td>{{ $user->email_user }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge 
                                    @if(strtolower($role->nama_role) == 'admin') bg-danger 
                                    @elseif(strtolower($role->nama_role) == 'operator') bg-info text-dark
                                    @elseif(strtolower($role->nama_role) == 'dokter') bg-success
                                    @else bg-secondary @endif">
                                    {{ ucfirst($role->nama_role) }}
                                </span>
                            @endforeach
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                             <div class="d-flex gap-2 justify-content-end">
                                {{-- PERBAIKAN: Tombol Edit ditambahkan di sini, tanpa kondisi --}}
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" @if($user->id_user === auth()->id()) disabled @endif>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection