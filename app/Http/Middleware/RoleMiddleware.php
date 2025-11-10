<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes: ->middleware(["auth", \App\Http\Middleware\RoleMiddleware::class . ':admin,manager'])
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            // Not authenticated; let the auth middleware redirect to login
            return redirect()->route('login');
        }

        $role = $user->role ?? 'customer';

        // If no roles were provided, allow access
        if (empty($roles)) {
            return $next($request);
        }

        // Roles passed via middleware are a single string if parameters used like 'admin,manager'
        // but Laravel will pass them as a single string in $roles[0] when using the concatenated class string.
        // Normalize to a flattened list.
        $flat = [];
        foreach ($roles as $r) {
            foreach (explode(',', (string) $r) as $p) {
                $p = trim($p);
                if ($p !== '') {
                    $flat[] = $p;
                }
            }
        }

        if (in_array($role, $flat, true)) {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}
