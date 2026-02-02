{{--
    Superadmin Settings Page
    Platform configuration using reusable layout
--}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-[#222222] tracking-tighter">Platform Settings</h1>
            <p class="text-[#222222]/40 text-sm font-medium mt-1">Configure system-wide settings</p>
        </div>
        <a href="{{ route('superadmin.dashboard') }}" class="px-4 py-2 bg-[#222222]/10 hover:bg-[#222222] hover:text-white text-[#222222] rounded-xl text-[10px] font-black uppercase tracking-widest transition-all inline-flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Back to Dashboard</span>
        </a>
    </div>

    {{-- Settings Form --}}
    <div class="bg-white rounded-xl border border-black/5 shadow-sm p-8">
        <form action="{{ route('superadmin.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- General Settings --}}
            <div class="space-y-6">
                <h3 class="text-sm font-black text-[#222222] uppercase tracking-wider border-b border-black/5 pb-4">
                    General Settings
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#222222]/60 uppercase tracking-wider">
                            Platform Name
                        </label>
                        <input 
                            type="text" 
                            name="platform_name" 
                            value="{{ old('platform_name', config('app.name')) }}"
                            class="w-full px-4 py-3 bg-[#F8F8F8] border border-black/5 rounded-xl text-sm font-medium text-[#222222] focus:outline-none focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all"
                        >
                        @error('platform_name')
                            <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#222222]/60 uppercase tracking-wider">
                            Support Email
                        </label>
                        <input 
                            type="email" 
                            name="support_email" 
                            value="{{ old('support_email', 'support@merrymeals.org') }}"
                            class="w-full px-4 py-3 bg-[#F8F8F8] border border-black/5 rounded-xl text-sm font-medium text-[#222222] focus:outline-none focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all"
                        >
                        @error('support_email')
                            <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Delivery Settings --}}
            <div class="space-y-6">
                <h3 class="text-sm font-black text-[#222222] uppercase tracking-wider border-b border-black/5 pb-4">
                    Delivery Settings
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-[#222222]/60 uppercase tracking-wider">
                            Max Delivery Time (minutes)
                        </label>
                        <input 
                            type="number" 
                            name="max_delivery_time" 
                            value="{{ old('max_delivery_time', 60) }}"
                            min="30"
                            max="180"
                            class="w-full px-4 py-3 bg-[#F8F8F8] border border-black/5 rounded-xl text-sm font-medium text-[#222222] focus:outline-none focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all"
                        >
                        @error('max_delivery_time')
                            <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                        @enderror
                        <p class="text-[10px] text-[#222222]/40">Alert threshold for late deliveries (30-180 min)</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end pt-6 border-t border-black/5">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-[#FF7B54] hover:bg-[#222222] text-[#222222] hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all"
                >
                    Save Settings
                </button>
            </div>
        </form>
    </div>

    {{-- Danger Zone --}}
    <div class="bg-red-500/5 border border-red-500/20 rounded-xl p-8">
        <h3 class="text-sm font-black text-red-500 uppercase tracking-wider mb-4">Danger Zone</h3>
        <p class="text-sm text-[#222222]/60 mb-6">These actions are irreversible. Please proceed with caution.</p>
        
        <div class="flex flex-wrap gap-4">
            <button 
                type="button"
                onclick="alert('This feature is not yet implemented.')"
                class="px-4 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all"
            >
                Clear All Logs
            </button>
            <button 
                type="button"
                onclick="alert('This feature is not yet implemented.')"
                class="px-4 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all"
            >
                Reset Platform
            </button>
        </div>
    </div>
@endsection
