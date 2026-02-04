<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Enhanced Role-Based Access Control Middleware
 * Based on ACCESS_CONTROL.md specifications
 */
class Roles
{
    /**
     * Role hierarchy: higher roles can access lower role routes
     * Superadmin inherits access to all other roles
     */
    protected array $roleHierarchy = [
        'superadmin' => ['admin', 'member', 'partner', 'driver'],
        'admin' => [],
        'member' => [],
        'partner' => [],
        'driver' => [],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  mixed  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check authentication
        if (! Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Unauthenticated',
                    'message' => 'You must be logged in to access this resource.',
                ], 401);
            }

            return redirect()->route('login')
                ->with('error', 'Please log in to continue.');
        }

        $user = auth()->user();

        // Check if user has access via direct role or hierarchy
        if ($this->hasAccess($user->role, $roles)) {
            return $next($request);
        }

        // Handle unauthorized access
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'You do not have permission to access this resource.',
            ], 403);
        }

        // Flash error message and abort
        abort(403, 'You do not have permission to access this resource.');
    }

    /**
     * Check if user role has access to any of the allowed roles
     */
    protected function hasAccess(string $userRole, array $allowedRoles): bool
    {
        // Direct role match
        if (in_array($userRole, $allowedRoles)) {
            return true;
        }

        // Check role hierarchy (superadmin can access all)
        if (isset($this->roleHierarchy[$userRole])) {
            // If user is superadmin, they can access ANY role's routes
            if ($userRole === 'superadmin') {
                return true;
            }

            // Check if allowed role is in inherited roles
            foreach ($allowedRoles as $role) {
                if (in_array($role, $this->roleHierarchy[$userRole])) {
                    return true;
                }
            }
        }

        return false;
    }
}
