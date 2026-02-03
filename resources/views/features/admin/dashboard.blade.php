{{--
    Admin Dashboard Layout
    Unified components and optimized data passing
--}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    @if(Request::routeIs('admin.dashboard'))
    {{-- Header Section --}}
    <div class="mb-12">
        <h1 class="text-4xl font-black text-dark tracking-tighter">System Overview</h1>
        <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Centralized Administration • Real-time Monitoring</p>
    </div>

    {{-- Stat Cards Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 mb-12">
        <x-dashboard.stat-card 
            label="Total Platform Users" 
            :value="number_format($stats['total_users'])" 
            color="primary"
            subtitle="Registered accounts across all roles"
            :percentage="$growth['users']"
        />

        <x-dashboard.stat-card 
            label="Financial Support" 
            :value="'$'.number_format($stats['total_donations'])" 
            color="dark"
            subtitle="Total community contributions"
            :percentage="$growth['donations']"
        />

        <x-dashboard.stat-card 
            label="Service Impact" 
            :value="number_format($stats['delivered_orders'])" 
            color="success"
            subtitle="Total meals successfully delivered"
            :percentage="$growth['orders']"
        />
    </div>

    {{-- Activity Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
        {{-- Chart Section --}}
        <div class="lg:col-span-8 bg-white rounded-3xl p-10 border border-black/5 shadow-sm">
            @include('features.admin.partials.activity-chart')
        </div>

        {{-- Call to Action Card --}}
        <div class="lg:col-span-4 bg-[#FF7B54] rounded-[2.5rem] p-10 text-white shadow-2xl shadow-primary/20 relative overflow-hidden group">
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-[0.4em] opacity-60">Strategic Analytics</span>
                    <h4 class="text-3xl font-black mt-6 tracking-tight leading-tight">Projecting Growth for 2026</h4>
                    <p class="mt-6 text-sm opacity-80 font-medium leading-relaxed">System monitoring indicates a {{ $growth['users'] }}% increase in new member registrations this month.</p>
                </div>
                <div class="mt-12">
                    <a href="{{ route('admin.reports.index') }}" 
                       class="w-full py-5 bg-white text-dark rounded-2xl font-black text-[11px] uppercase tracking-widest hover:scale-[1.03] transition-all shadow-xl block text-center">
                        Generate Intelligence Report
                    </a>
                </div>
            </div>
            {{-- Decorative elements --}}
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-black/5 rounded-full blur-2xl group-hover:translate-x-10 transition-transform duration-700"></div>
        </div>
    </div>
    @endif

    {{-- Data Content (Table or Form) --}}
    <div class="mt-12 animate-on-scroll">
        @yield('dashboard_admin')
    </div>
@endsection

@section('js_custom')
    @vite(['resources/js/docs-animations.js'])
@endsection
