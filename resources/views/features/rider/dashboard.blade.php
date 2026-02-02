@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
        .text-h6 { font-size: 1.25rem; font-weight: 800; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter">
    {{-- Desktop Sidebar --}}
    @include('features.rider.partials.sidebar', ['isAvailable' => $isAvailable ?? true])

    {{-- Mobile Header --}}
    <header x-data="{ mobileMenuOpen: false }" class="lg:hidden bg-white border-b border-black/5 p-4 sticky top-0 z-40">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-xl flex items-center justify-center text-white">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                </div>
                <span class="font-black text-dark tracking-tight uppercase">Driver</span>
            </div>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-dark/60 hover:text-dark">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
        </div>

        {{-- Mobile Drawer --}}
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             style="display: none;"
             class="fixed inset-0 z-50 flex">
            <div class="fixed inset-0 bg-dark/20 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-[#222222] p-6 pb-4">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                        </div>
                        <span class="text-white font-black tracking-widest uppercase text-xs">Driver</span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="text-white/40 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <nav class="space-y-2 flex-1">
                    <a href="{{ route('driver.dashboard') }}" class="block px-4 py-3 bg-primary text-dark rounded-xl font-bold text-sm tracking-tight">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">My Profile</a>
                </nav>

                <div class="pt-6 border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full flex items-center justify-center px-4 py-3 bg-red-500/10 text-red-500 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content Area --}}
    <div class="lg:pl-[320px]">
        <div class="max-w-[1800px] mx-auto p-4 md:p-8 lg:p-12 space-y-12">
            
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/20 text-green-600 px-6 py-4 rounded-xl text-sm font-bold flex items-center space-x-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-h2 text-dark tracking-tighter">Welcome back, {{ $driver->name ?? 'Driver' }}</h1>
                    <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Driver Dashboard • {{ now()->format('l, F j') }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2
                        {{ ($isAvailable ?? true) ? 'bg-green-500/10 text-green-600' : 'bg-gray-500/10 text-gray-500' }}">
                        <span class="block w-2 h-2 rounded-full {{ ($isAvailable ?? true) ? 'bg-green-500 animate-pulse' : 'bg-gray-400' }}"></span>
                        {{ ($isAvailable ?? true) ? 'Available' : 'Offline' }}
                    </span>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @include('features.rider.partials.stat-card', [
                    'label' => 'Assigned Today',
                    'value' => $stats['assigned_today'] ?? 0,
                    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'color' => 'default'
                ])
                
                @include('features.rider.partials.stat-card', [
                    'label' => 'In Transit',
                    'value' => $stats['in_transit'] ?? 0,
                    'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0',
                    'color' => 'primary',
                    'subtitle' => 'Active deliveries'
                ])
                
                @include('features.rider.partials.stat-card', [
                    'label' => 'Completed Today',
                    'value' => $stats['completed_today'] ?? 0,
                    'icon' => 'M5 13l4 4L19 7',
                    'color' => 'success'
                ])
                
                @include('features.rider.partials.stat-card', [
                    'label' => 'Total Deliveries',
                    'value' => $stats['total_deliveries'] ?? 0,
                    'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                    'color' => 'dark',
                    'subtitle' => 'All time'
                ])
            </div>

            {{-- Active Deliveries Section --}}
            <div>
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h4 class="text-2xl font-black text-dark tracking-tighter">Active Deliveries</h4>
                        <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Orders ready for pickup or in transit</p>
                    </div>
                    <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ count($activeDeliveries ?? []) }} Active
                    </span>
                </div>

                @if(isset($activeDeliveries) && count($activeDeliveries) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($activeDeliveries as $order)
                            @include('features.rider.partials.delivery-card', ['order' => $order])
                        @endforeach
                    </div>
                @else
                    <div class="bg-white p-12 rounded-xl shadow-sm border border-black/5 text-center">
                        <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center text-primary mx-auto mb-6">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-dark tracking-tight mb-2">No Active Deliveries</h3>
                        <p class="text-dark/40 font-medium text-sm max-w-md mx-auto">
                            {{ ($isAvailable ?? true) ? 'You\'re all caught up! New delivery requests will appear here.' : 'Set yourself to "Available" to receive new delivery requests.' }}
                        </p>
                    </div>
                @endif
            </div>

            {{-- Recent Deliveries Table --}}
            <div class="bg-white rounded-xl p-8 md:p-10 border border-black/5 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h4 class="text-2xl font-black text-dark tracking-tighter">Recent Deliveries</h4>
                        <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Your completed deliveries</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                                <th class="pb-6 pl-2">Order ID</th>
                                <th class="pb-6">Meal</th>
                                <th class="pb-6">Recipient</th>
                                <th class="pb-6">Status</th>
                                <th class="pb-6 pr-2 text-right">Completed</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @forelse($recentDeliveries ?? [] as $order)
                            <tr class="group hover:bg-dark/5 transition-all">
                                <td class="py-6 pl-2">
                                    <span class="text-xs font-black text-dark uppercase tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center space-x-3">
                                        @if($order->meal && $order->meal->mealImage)
                                        <img src="{{ asset('storage/' . $order->meal->mealImage) }}" class="w-8 h-8 rounded-lg object-cover" alt="">
                                        @endif
                                        <span class="text-xs font-bold text-dark">{{ $order->meal->mealName ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <span class="text-xs font-bold text-dark/60">{{ $order->user->name ?? 'Member' }}</span>
                                </td>
                                <td class="py-6">
                                    <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-green-500/10 text-green-600">
                                        Delivered
                                    </span>
                                </td>
                                <td class="py-6 pr-2 text-right">
                                    <span class="text-[10px] font-bold text-dark/30">{{ $order->updated_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <p class="text-dark/20 text-xs font-black uppercase tracking-[0.4em]">No deliveries yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Logout FAB (Mobile) --}}
    <div class="fixed bottom-6 right-6 z-[100] lg:hidden">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-14 h-14 bg-dark text-white rounded-xl shadow-2xl hover:scale-110 transition-all flex items-center justify-center group">
                <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</main>
@endsection

@section('js_custom')
    @vite(['resources/js/docs-animations.js'])
@endsection