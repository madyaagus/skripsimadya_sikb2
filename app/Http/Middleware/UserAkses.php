<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @param  string[] ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Mendapatkan user saat ini
        $user = auth()->user();

        // Memeriksa apakah user memiliki salah satu dari roles yang diizinkan
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika tidak memiliki izin, bisa diarahkan ke halaman lain atau menampilkan pesan error
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
