<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Ambil semua role user, lalu cek apakah salah satu cocok
        $userRoles = $user->roles->pluck('nama_role')->map(fn($r) => strtolower($r))->toArray();

        $allowedRoles = array_map('strtolower', $roles);

        if (!array_intersect($userRoles, $allowedRoles)) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
