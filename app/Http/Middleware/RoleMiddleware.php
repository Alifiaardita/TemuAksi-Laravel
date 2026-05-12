<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
{
//      dd([
//     'user' => Auth::user(),
//     'role_direct' => Auth::user()->role,
//     'role_relation' => Auth::user()->role->name ?? null,
// ]);
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $userRole = strtolower(trim(Auth::user()->role));

    $roles = array_map(fn($r) => strtolower(trim($r)), $roles);

    if (!in_array($userRole, $roles)) {
        abort(403, 'Akses ditolak');
    }

    return $next($request);
}
}
