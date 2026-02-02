{{--
    Base Dashboard Layout
    Reusable layout for all role dashboards
    Based on DASHBOARD_ARCHITECTURE.md specifications
--}}
@extends('layouts.main')

@php
    $role = auth()->user()->role ?? 'member';
    $navItems = config("dashboard.navigation.{$role}", []);
    $features = config("dashboard.features.{$role}", []);
@endphp

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter" x-data="{ mobileMenuOpen: false }">
    {{-- Desktop Sidebar --}}
    @include('layouts.dashboard.sidebar', [
        'role' => $role,
        'navItems' => $navItems
    ])

    {{-- Mobile Header --}}
    @include('layouts.dashboard.header', [
        'role' => $role,
        'navItems' => $navItems
    ])

    {{-- Mobile Overlay --}}
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/50 z-40 lg:hidden"
        style="display: none;"
    ></div>

    {{-- Mobile Drawer --}}
    @include('components.dashboard.mobile-drawer', [
        'role' => $role,
        'navItems' => $navItems
    ])

    {{-- Main Content --}}
    <div class="lg:pl-[320px]">
        <div class="max-w-[1800px] mx-auto p-4 md:p-8 lg:p-12 space-y-8">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/20 text-green-600 px-6 py-4 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/20 text-red-600 px-6 py-4 rounded-xl text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Page Content --}}
            @yield('dashboard_content')
        </div>
    </div>

    {{-- Mobile FAB for Logout (optional) --}}
    <div class="fixed bottom-6 right-6 lg:hidden z-30">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-14 h-14 bg-red-500 hover:bg-red-600 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</main>
@endsection
