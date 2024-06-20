<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPegawai
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Selain Pegawai Abort
        if (!auth()->check()) {
            return redirect('/login');
        } elseif (auth()->check() && auth()->user()->role === 'Pelanggan') {
            return abort(403);
        }
        return $next($request);
    }
}
