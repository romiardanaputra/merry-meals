<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Role-Aware Navigation Helper
 * Filters navigation based on route existence and user permissions
 */
class RoleNavigation
{
    /**
     * Check if a route exists and is accessible to current user
     */
    public static function isRouteAccessible(string $routeName): bool
    {
        // First check if route exists
        if (!Route::has($routeName)) {
            return false;
        }

        // Get current user
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        // Get route and check for role middleware
        $route = Route::getRoutes()->getByName($routeName);
        if (!$route) {
            return false;
        }

        // Check if route has role middleware and if user matches
        $middleware = $route->middleware();
        $userRole = $user->role;

        foreach ($middleware as $m) {
            // Check for roles middleware
            if (str_starts_with($m, 'roles:')) {
                $allowedRoles = explode(',', substr($m, 6));
                
                // Superadmin has access to all
                if ($userRole === 'superadmin') {
                    return true;
                }
                
                // Check if user role is in allowed roles
                if (in_array($userRole, $allowedRoles)) {
                    return true;
                }
                
                // If not in allowed roles, route is not accessible
                return false;
            }
        }

        // If no role middleware, assume accessible
        return true;
    }

    /**
     * Filter navigation items to only accessible ones
     */
    public static function filterNavigation(array $navItems): array
    {
        return array_filter($navItems, function ($item) {
            return self::isRouteAccessible($item['route'] ?? '');
        });
    }

    /**
     * Get role-specific navigation with accessibility checks
     */
    public static function getNavigation(string $role): array
    {
        $navItems = config("dashboard.navigation.{$role}", []);
        return self::filterNavigation($navItems);
    }
}
