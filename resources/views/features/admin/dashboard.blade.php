{{--
    Admin Dashboard Layout
    Uses unified base layout with consistent navigation
    Migrated to use layouts.dashboard.base
--}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    @if(Request::routeIs('admin.index'))
    {{-- Stat Cards Row - Only on main admin page --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
        <x-dashboard.stat-card 
            label="Total Users" 
            :value="\App\Models\User::count()" 
            color="primary"
            subtitle="All registered users"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-[#222222]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card 
            label="Total Donations" 
            :value="'$'.number_format(\App\Models\Donation::sum('donationAmount'))" 
            color="dark"
            subtitle="All time donations"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card 
            label="Meals Delivered" 
            :value="\App\Models\Order::where('status', 'delivered')->count()" 
            color="success"
            subtitle="Successfully delivered"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>
    </div>

    {{-- Activity Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10">
        <div class="lg:col-span-8">
            @include('features.admin.partials.activity-chart')
        </div>
        <div class="lg:col-span-4 bg-[#FF7B54] rounded-xl p-8 lg:p-10 text-white shadow-xl shadow-primary/20 relative overflow-hidden group">
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] opacity-60">Impact Report</span>
                    <h4 class="text-2xl font-black mt-4 tracking-tight leading-tight">Merry Meal 2026</h4>
                </div>
                <div class="mt-8">
                    <p class="text-xs opacity-80 font-medium">Over 20k+ lives touched. Keep up the amazing work!</p>
                    <a href="{{ route('admin.reports.index') }}" class="mt-8 w-full py-4 bg-white text-[#222222] rounded-xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-xl block text-center">Full Report</a>
                </div>
            </div>
            <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>
        </div>
    </div>
    @endif

    {{-- Data Content (Table or Form) --}}
    <div class="animate-on-scroll">
        @yield('dashboard_admin')
    </div>
@endsection

@section('js_custom')
    @vite(['resources/js/docs-animations.js'])
@endsection
