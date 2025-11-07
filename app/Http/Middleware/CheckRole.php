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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if ($user->role->name === $role) {
                return $next($request);
            }
        }

        // If user is owner, they have access to everything
        if ($user->isOwner()) {
            return $next($request);
        }

        // If user is admin, they have access to admin and customer areas
        if ($user->isAdmin() && in_array('admin', $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
