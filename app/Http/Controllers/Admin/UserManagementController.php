<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles')->latest();

        if ($request->filled('search')) {
            $query->where('nama_user', 'like', '%' . $request->search . '%')
                  ->orWhere('email_user', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('nama_role', $request->role);
            });
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }
    
    public function create()
    {
        $roles = Role::whereIn('nama_role', ['admin', 'operator'])->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
            'email_user' => ['required', 'string', 'email', 'max:255', 'unique:users,email_user'],
            'pass_user' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id_role'],
        ]);

        $user = User::create([
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'pass_user' => Hash::make($request->pass_user),
        ]);

        $user->roles()->attach($request->role_id);

        return redirect()->route('admin.users.index')->with('success', 'Administrator created successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting self
        if ($user->id_user === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}