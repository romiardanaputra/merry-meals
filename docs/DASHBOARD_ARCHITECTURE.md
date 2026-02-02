# Merry Meals - Dashboard Architecture Guide

## Overview

Dokumen ini menjelaskan arsitektur reusable dashboard layout dengan role-based access control untuk konsistensi UI/UX di seluruh platform.

---

## Design Principles

### 1. Single Source Layout

Semua dashboard menggunakan layout yang sama dengan variasi berdasarkan role.

### 2. Role-Based Components

Navigasi dan konten ditampilkan sesuai permissions user.

### 3. Responsive First

Mobile-first design dengan sidebar drawer untuk mobile.

---

## Layout Architecture

```
layouts/
├── main.blade.php              # Base layout
├── dashboard/
│   ├── base.blade.php          # Shared dashboard layout
│   ├── sidebar.blade.php       # Reusable sidebar component
│   └── header.blade.php        # Reusable header component

components/
├── dashboard/
│   ├── stat-card.blade.php     # Statistics card
│   ├── data-table.blade.php    # Reusable table
│   ├── nav-item.blade.php      # Navigation item
│   └── mobile-drawer.blade.php # Mobile navigation
```

---

## Proposed Reusable Dashboard Layout

### Base Dashboard Layout

```blade
{{-- layouts/dashboard/base.blade.php --}}
@extends('layouts.main')

@section('component_content')
  <main class="min-h-screen bg-[#F8F8F8] font-inter">
    {{-- Desktop Sidebar --}}
    @include(
      'layouts.dashboard.sidebar',
      [
        'role' => $role,
        'navItems' => $navItems,
      ]
    )

    {{-- Mobile Header --}}
    @include(
      'layouts.dashboard.header',
      [
        'role' => $role,
        'navItems' => $navItems,
      ]
    )

    {{-- Main Content --}}
    <div class="lg:pl-[320px]">
      <div class="mx-auto max-w-[1800px] space-y-12 p-4 md:p-8 lg:p-12">
        @yield('dashboard_content')
      </div>
    </div>
  </main>
@endsection
```

### Reusable Sidebar Component

```blade
{{-- layouts/dashboard/sidebar.blade.php --}}
<aside class="fixed inset-y-0 left-0 z-50 hidden w-[320px] flex-col bg-[#222222] lg:flex">
  {{-- Logo --}}
  <div class="border-b border-white/5 p-8">
    <div class="flex items-center space-x-4">
      <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white">
        <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="h-8 w-8" alt="" />
      </div>
      <div>
        <h1 class="text-sm font-black uppercase tracking-tight text-white">Merry Meals</h1>
        <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-primary">{{ $role }} Portal</span>
      </div>
    </div>
  </div>

  {{-- User Profile --}}
  <div class="border-b border-white/5 p-8">
    <div class="flex items-center space-x-4">
      <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-primary">
        <span class="text-xl font-black text-dark">{{ substr(auth()->user()->name, 0, 1) }}</span>
      </div>
      <div>
        <p class="text-sm font-black text-white">{{ auth()->user()->name }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest text-white/40">{{ ucfirst($role) }}</p>
      </div>
    </div>
  </div>

  {{-- Navigation --}}
  <nav class="flex-1 space-y-2 overflow-y-auto p-6">
    @foreach ($navItems as $item)
      @include('components.dashboard.nav-item', $item)
    @endforeach
  </nav>

  {{-- Logout --}}
  <div class="border-t border-white/5 p-6">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button
        type="submit"
        class="flex w-full items-center justify-center space-x-3 rounded-xl bg-red-500/10 px-5 py-4 text-red-400 transition-all hover:bg-red-500 hover:text-white"
      >
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
          />
        </svg>
        <span class="text-[10px] font-black uppercase tracking-widest">Sign Out</span>
      </button>
    </form>
  </div>
</aside>
```

---

## Navigation Configuration

### Role-Based Navigation Items

```php
// config/dashboard.php (proposed)
return [
    'navigation' => [
        'superadmin' => [
            ['route' => 'superadmin.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'admin.index', 'label' => 'All Users', 'icon' => 'users'],
            ['route' => 'admin.partners.index', 'label' => 'Partners', 'icon' => 'building'],
            ['route' => 'donator.list', 'label' => 'Donations', 'icon' => 'heart'],
            ['route' => 'admin.reports.index', 'label' => 'Reports', 'icon' => 'chart'],
            ['route' => 'settings.index', 'label' => 'Settings', 'icon' => 'cog'],
        ],

        'admin' => [
            ['route' => 'admin.index', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'admin.index', 'label' => 'Users', 'icon' => 'users'],
            ['route' => 'donator.list', 'label' => 'Donations', 'icon' => 'heart'],
            ['route' => 'admin.orders.index', 'label' => 'Orders', 'icon' => 'shopping-bag'],
            ['route' => 'admin.reports.index', 'label' => 'Reports', 'icon' => 'chart'],
        ],

        'member' => [
            ['route' => 'member.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'meal.menu', 'label' => 'Browse Meals', 'icon' => 'food'],
            ['route' => 'member.orders', 'label' => 'My Orders', 'icon' => 'shopping-bag'],
            ['route' => 'member.nutrition', 'label' => 'Nutrition', 'icon' => 'heart'],
            ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'user'],
        ],

        'driver' => [
            ['route' => 'driver.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'driver.deliveries', 'label' => 'My Deliveries', 'icon' => 'truck'],
            ['route' => 'driver.history', 'label' => 'History', 'icon' => 'clock'],
            ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'user'],
        ],

        'partner' => [
            ['route' => 'partner.index', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'meal.index', 'label' => 'Meals', 'icon' => 'food'],
            ['route' => 'partner.orders.index', 'label' => 'Orders', 'icon' => 'shopping-bag'],
            ['route' => 'partner.profile.edit', 'label' => 'Restaurant', 'icon' => 'building'],
        ],
    ],
];
```

---

## Access Control Implementation

### Enhanced Roles Middleware

```php
// app/Http/Middleware/Roles.php (enhanced)
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Super admin has access to everything
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Check if user role is in allowed roles
        if (!collect($roles)->contains($user->role)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
```

### Route Protection

```php
// routes/web.php (best practice structure)
Route::middleware(['auth', 'verified'])->group(function () {

    // Dynamic dashboard redirect
    Route::get('/dashboard', [DashboardController::class, 'redirect'])
        ->name('dashboard');

    // Super Admin (can access all)
    Route::middleware('roles:superadmin,admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Admin routes...
        });

    // Member only
    Route::middleware('roles:member')
        ->prefix('member')
        ->name('member.')
        ->group(function () {
            // Member routes...
        });

    // Driver only
    Route::middleware('roles:driver')
        ->prefix('driver')
        ->name('driver.')
        ->group(function () {
            // Driver routes...
        });

    // Partner only
    Route::middleware('roles:partner')
        ->prefix('partner')
        ->name('partner.')
        ->group(function () {
            // Partner routes...
        });
});
```

---

## Component Library

### Stat Card Component

```blade
{{-- components/dashboard/stat-card.blade.php --}}

@props([
  'label',
  'value',
  'icon',
  'color' => 'default',
  'subtitle' => null,
])

@php
  $colorClasses = match ($color) {
    'primary' => 'bg-primary text-dark shadow-primary/20',
    'success' => 'bg-green-500 text-white shadow-green-500/20',
    'warning' => 'bg-amber-500 text-dark shadow-amber-500/20',
    'dark' => 'bg-dark text-white shadow-dark/20',
    default => 'border border-black/5 bg-white text-dark shadow-dark/5',
  };
@endphp

<div class="{{ $colorClasses }} rounded-xl p-8 shadow-lg transition-all duration-500 hover:scale-[1.02]">
  <div class="flex items-start justify-between">
    <div class="space-y-1">
      <span class="text-[10px] font-black uppercase tracking-wider opacity-60">{{ $label }}</span>
      <h2 class="text-4xl font-black tracking-tighter">{{ $value }}</h2>
      @if ($subtitle)
        <p class="text-[11px] font-bold opacity-60">{{ $subtitle }}</p>
      @endif
    </div>
    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20">
      {{ $icon }}
    </div>
  </div>
</div>
```

### Data Table Component

```blade
{{-- components/dashboard/data-table.blade.php --}}

@props([
  'headers',
  'emptyMessage' => 'No data available',
])

<div class="overflow-hidden rounded-xl border border-black/5 bg-white shadow-sm">
  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead>
        <tr class="border-b border-black/5 text-[10px] font-black uppercase tracking-[0.2em] text-dark/20">
          @foreach ($headers as $header)
            <th class="px-6 pb-6 pt-6">{{ $header }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody class="divide-y divide-black/5">
        {{ $slot }}
      </tbody>
    </table>
  </div>
</div>
```

---

## Implementation Checklist

### Phase 1: Base Layout

- [ ] Create `layouts/dashboard/base.blade.php`
- [ ] Create `layouts/dashboard/sidebar.blade.php`
- [ ] Create `layouts/dashboard/header.blade.php`
- [ ] Create navigation config file

### Phase 2: Components

- [ ] Create `components/dashboard/stat-card.blade.php`
- [ ] Create `components/dashboard/nav-item.blade.php`
- [ ] Create `components/dashboard/data-table.blade.php`
- [ ] Create `components/dashboard/mobile-drawer.blade.php`

### Phase 3: Migration

- [ ] Migrate Admin dashboard to use base layout
- [ ] Migrate Partner dashboard to use base layout
- [ ] Migrate Driver dashboard to use base layout
- [ ] Migrate Member dashboard to use base layout
- [ ] Migrate Superadmin dashboard to use base layout

### Phase 4: Testing

- [ ] Test access control for each role
- [ ] Test navigation visibility per role
- [ ] Test responsive behavior
- [ ] Test unauthorized access handling
