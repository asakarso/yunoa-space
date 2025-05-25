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
            return redirect('/login'); // redirect kalau belum login
        }

        if (!in_array(Auth::user()->role->nama_role, $roles)) {
            abort(403, 'Akses tidak diizinkan.'); // akses ditolak kalau bukan role yang sesuai
        }

        return $next($request);
    }
}
