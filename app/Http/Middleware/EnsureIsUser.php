<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsUser
{
    /**
     * Handle an incoming request.
     * Hanya user biasa (role=user) yang boleh akses. Admin diarahkan ke dashboard admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isUser()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
