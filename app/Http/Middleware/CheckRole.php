<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('auth.showLogin');
        }

        // Check if the user has at least one of the required roles
        foreach ($roles as $role) {
            $user = auth()->user() ?? null;
            if ($user  &&  $user->hasRole($role)) {
                return $next($request);
            }
        }

        // If the user does not have any of the required roles, redirect back
        return redirect()->route('home')->with('error', 'Unauthorized.');
    }
}
