<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($role === 'admin' && $user->role !== 'admin') {
            // return redirect()->route('admin.index');
        }

        if ($role === 'client' && $user->role !== 'client') {
            return redirect()->route('client.index');
        }

        return $next($request);
    }
}
