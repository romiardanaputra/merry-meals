# Merry Meals - Access Control Implementation Guide

## Overview

Dokumen ini menjelaskan implementasi Role-Based Access Control (RBAC) untuk platform Merry Meals menggunakan Laravel middleware.

---

## Current Implementation

### Roles Middleware

```php
// app/Http/Middleware/Roles.php
class Roles
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403);
        }
        return collect($roles)->contains(auth()->user()->role)
            ? $next($request)
            : back();
    }
}
```

### User Model Constants

```php
// app/Models/User.php
const ROLE_SUPERADMIN = 'superadmin';
const ROLE_ADMIN = 'admin';
const ROLE_MEMBER = 'member';
const ROLE_PARTNER = 'partner';
const ROLE_DRIVER = 'driver';
```

---

## Enhanced Implementation (Recommended)

### 1. Enhanced Roles Middleware

```php
// app/Http/Middleware/Roles.php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{
    /**
     * Role hierarchy: higher roles inherit lower role permissions
     */
    protected $roleHierarchy = [
        'superadmin' => ['admin', 'member', 'partner', 'driver'],
        'admin' => [],
        'member' => [],
        'partner' => [],
        'driver' => [],
    ];

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Not authenticated
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check direct role match or hierarchy
        if ($this->hasAccess($user->role, $roles)) {
            return $next($request);
        }

        // Unauthorized
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        abort(403, 'You do not have access to this resource.');
    }

    protected function hasAccess(string $userRole, array $allowedRoles): bool
    {
        // Direct match
        if (in_array($userRole, $allowedRoles)) {
            return true;
        }

        // Check hierarchy (superadmin can access all)
        if (isset($this->roleHierarchy[$userRole])) {
            foreach ($allowedRoles as $role) {
                if (in_array($role, $this->roleHierarchy[$userRole])) {
                    return true;
                }
            }
        }

        return false;
    }
}
```

### 2. Permission Gates

```php
// app/Providers/AuthServiceProvider.php
use Illuminate\Support\Facades\Gate;

public function boot()
{
    // User Management
    Gate::define('manage-users', fn($user) =>
        in_array($user->role, ['superadmin', 'admin'])
    );

    Gate::define('manage-all-users', fn($user) =>
        $user->role === 'superadmin'
    );

    // Order Management
    Gate::define('view-all-orders', fn($user) =>
        in_array($user->role, ['superadmin', 'admin'])
    );

    Gate::define('assign-driver', fn($user) =>
        in_array($user->role, ['superadmin', 'admin'])
    );

    // Meal Management
    Gate::define('manage-meals', fn($user) =>
        in_array($user->role, ['superadmin', 'admin', 'partner'])
    );

    // Partner Management
    Gate::define('approve-partners', fn($user) =>
        in_array($user->role, ['superadmin', 'admin'])
    );

    // Donation Management
    Gate::define('manage-donations', fn($user) =>
        in_array($user->role, ['superadmin', 'admin'])
    );

    // Settings
    Gate::define('manage-settings', fn($user) =>
        $user->role === 'superadmin'
    );
}
```

### 3. Resource Policies

```php
// app/Policies/OrderPolicy.php
<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        // Super admin and admin can view all
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return true;
        }

        // Member can view own orders
        if ($user->role === 'member') {
            return $order->userID === $user->id;
        }

        // Driver can view assigned orders
        if ($user->role === 'driver') {
            return $order->volunteerID === $user->id;
        }

        // Partner can view orders for their restaurant
        if ($user->role === 'partner') {
            return $order->partnerID === $user->partner?->id;
        }

        return false;
    }

    public function update(User $user, Order $order): bool
    {
        // Admin can update any order
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return true;
        }

        // Driver can update assigned orders (status only)
        if ($user->role === 'driver') {
            return $order->volunteerID === $user->id;
        }

        // Partner can update their orders (preparation status)
        if ($user->role === 'partner') {
            return $order->partnerID === $user->partner?->id;
        }

        return false;
    }
}
```

---

## Route Protection Patterns

### Pattern 1: Single Role

```php
Route::middleware('roles:admin')->group(function () {
    // Only admin can access
});
```

### Pattern 2: Multiple Roles

```php
Route::middleware('roles:superadmin,admin')->group(function () {
    // Superadmin and admin can access
});
```

### Pattern 3: Combined with Gates

```php
Route::get('/orders', function () {
    Gate::authorize('view-all-orders');
    // ...
})->middleware('auth');
```

### Pattern 4: Controller Authorization

```php
class OrderController extends Controller
{
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        // Policy check
    }
}
```

---

## Blade Access Control

### Check Role

```blade
@if (auth()->user()->isAdmin())
  {{-- Admin content --}}
@endif
```

### Check Gate

```blade
@can('manage-users')
  <a href="{{ route('admin.users') }}">Manage Users</a>
@endcan
```

### Check Multiple

```blade
@canany(['manage-users', 'view-all-orders'])
  <li>Admin Section</li>
@endcanany
```

---

## Access Matrix Reference

| Route Group        | Roles Allowed     |
| ------------------ | ----------------- |
| `/superadmin/*`    | superadmin        |
| `/admin/*`         | superadmin, admin |
| `/member/*`        | member            |
| `/partner/*`       | partner           |
| `/driver/*`        | driver            |
| `/profile`         | all authenticated |
| `/menu`, `/meal/*` | all authenticated |

---

## Security Checklist

- [x] All routes protected by middleware
- [x] Role constants defined in User model
- [x] Middleware registered in Kernel
- [ ] Gates defined in AuthServiceProvider
- [ ] Policies for Order, Meal, User models
- [ ] Blade directives for UI access control
- [ ] API routes protection (Sanctum)
- [ ] Audit logging for sensitive actions
