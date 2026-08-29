<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ABAC Role Middleware
 *
 * Usage in routes:  ->middleware('role:content_manager,super_admin')
 * The middleware resolves allowed roles from the comma-separated parameter list.
 * Passing 'super_admin' as an allowed role is redundant (super admins bypass all
 * checks) but is shown for clarity.
 */
class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        /** @var User|null $user */
        $user = $request->user();

        if (! $user) {
            return redirect()->route('manager.login');
        }

        // Super admins always pass
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if user's role is in the allowed list
        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        // Access denied — return branded 403
        abort(403, 'You do not have permission to access this area.');
    }
}
