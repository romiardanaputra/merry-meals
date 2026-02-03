@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="space-y-12">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-dark tracking-tighter capitalize">Welcome back, {{ auth()->user()->name ?? 'Driver' }}</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Driver Operations • {{ now()->format('l, F j') }}</p>
        </div>
        <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-dark/30">Status</span>
                <span class="px-5 py-2.5 rounded-[1.2rem] text-[9px] font-black uppercase tracking-widest flex items-center gap-3
                    {{ ($isAvailable ?? true) ? 'bg-green-500/10 text-green-600' : 'bg-gray-500/10 text-gray-500' }}">
                    <span class="block w-2.5 h-2.5 rounded-full {{ ($isAvailable ?? true) ? 'bg-green-500 animate-pulse' : 'bg-gray-400' }}"></span>
                    {{ ($isAvailable ?? true) ? 'Available' : 'Offline' }}
                </span>
            </div>
            
            <form action="{{ route('driver.availability.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="px-8 py-4 bg-dark text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-primary hover:text-dark hover:scale-105 active:scale-95 transition-all shadow-xl shadow-dark/10">
                    {{ ($isAvailable ?? true) ? 'Go Offline' : 'Go Online' }}
                </button>
            </form>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
        <x-dashboard.stat-card 
            label="Assigned Today" 
            :value="$stats['assigned_today'] ?? 0" 
            color="primary"
            icon="truck"
        />
        <x-dashboard.stat-card 
            label="In Transit" 
            :value="$stats['in_transit'] ?? 0" 
            color="warning"
            icon="clock"
        />
        <x-dashboard.stat-card 
            label="Completed Today" 
            :value="$stats['completed_today'] ?? 0" 
            color="success"
            icon="check-circle"
        />
        <x-dashboard.stat-card 
            label="Total Deliveries" 
            :value="$stats['total_deliveries'] ?? 0" 
            color="dark"
            icon="shopping-bag"
        />
    </div>

    {{-- Active Deliveries Section --}}
    <div class="space-y-6" x-data="{ lastRefresh: new Date(), refreshing: false }">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h4 class="text-2xl font-black text-dark tracking-tighter">Active Queue</h4>
                <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">
                    Real-time delivery fulfillment 
                    <span class="inline-flex items-center ml-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="ml-1 text-green-600">Updated {{ now()->format('H:i') }}</span>
                    </span>
                </p>
            </div>
            <div class="flex items-center space-x-3">
                {{-- Refresh Button --}}
                <button @click="refreshing = true; window.location.reload()" 
                        :class="refreshing ? 'animate-spin' : ''"
                        class="p-2 bg-dark/5 hover:bg-dark text-dark hover:text-white rounded-xl transition-all"
                        title="Refresh Queue">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
                @if(isset($activeDeliveries) && $activeDeliveries->total() > 1)
                    @php
                        $allDeliveries = $activeDeliveries->getCollection();
                        $addresses = $allDeliveries->map(fn($o) => $o->user->address ?? '')->filter()->values();
                        $mapsUrl = 'https://www.google.com/maps/dir/' . $addresses->map(fn($a) => urlencode($a))->join('/');
                    @endphp
                    <a href="{{ $mapsUrl }}" target="_blank"
                       class="hidden md:flex px-4 py-2 bg-blue-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg shadow-blue-500/20 items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <span>Optimize</span>
                    </a>
                @endif
                @if(isset($activeDeliveries))
                    <span class="px-4 py-2 bg-primary/10 text-primary rounded-xl text-[10px] font-black uppercase tracking-widest">
                        {{ $activeDeliveries->total() }} Total
                    </span>
                @endif
            </div>
        </div>

        {{-- Filter & Search Bar --}}
        <form action="{{ route('driver.dashboard') }}" method="GET" class="bg-white rounded-2xl p-4 border border-black/5 shadow-sm">
            <div class="flex flex-col md:flex-row gap-3">
                {{-- Search Input --}}
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-dark/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                           placeholder="Search member name or address..."
                           class="w-full pl-11 pr-4 py-3 bg-dark/5 border-none rounded-xl text-sm font-medium text-dark placeholder:text-dark/30 focus:ring-2 focus:ring-primary/20">
                </div>
                
                {{-- Status Filter --}}
                <select name="status" onchange="this.form.submit()"
                        class="px-4 py-3 bg-dark/5 border-none rounded-xl text-sm font-bold text-dark focus:ring-2 focus:ring-primary/20 min-w-[150px]">
                    <option value="all" {{ ($statusFilter ?? 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="assigned" {{ ($statusFilter ?? '') === 'assigned' ? 'selected' : '' }}>🔵 Assigned</option>
                    <option value="picked_up" {{ ($statusFilter ?? '') === 'picked_up' ? 'selected' : '' }}>🟡 Picked Up</option>
                    <option value="in_transit" {{ ($statusFilter ?? '') === 'in_transit' ? 'selected' : '' }}>🟠 In Transit</option>
                </select>
                
                {{-- Search Button (Mobile) --}}
                <button type="submit" class="md:hidden px-6 py-3 bg-dark text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-105 active:scale-95 transition-all">
                    Search
                </button>
                
                {{-- Clear Filters --}}
                @if(($search ?? null) || (($statusFilter ?? 'all') !== 'all'))
                    <a href="{{ route('driver.dashboard') }}" class="px-4 py-3 bg-red-50 text-red-500 rounded-xl text-xs font-bold hover:bg-red-100 transition-all text-center">
                        Clear
                    </a>
                @endif
            </div>
        </form>

        {{-- Delivery Cards Grid --}}
        @if(isset($activeDeliveries) && count($activeDeliveries) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($activeDeliveries as $order)
                    @include('features.rider.partials.delivery-card', ['order' => $order])
                @endforeach
            </div>
            
            {{-- Pagination --}}
            <div class="mt-8">
                {{ $activeDeliveries->links('partials.custom-pagination') }}
            </div>
        @else
            <div class="bg-white p-16 rounded-[2rem] border border-black/5 text-center shadow-sm">
                <div class="w-20 h-20 bg-dark/5 rounded-full flex items-center justify-center text-dark/10 mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1" />
                    </svg>
                </div>
                @if(($search ?? null) || (($statusFilter ?? 'all') !== 'all'))
                    <h3 class="text-xl font-black text-dark tracking-tight mb-2">No Results Found</h3>
                    <p class="text-dark/40 font-medium text-sm mb-4">Try adjusting your filters or search terms</p>
                    <a href="{{ route('driver.dashboard') }}" class="inline-block px-6 py-3 bg-dark text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all">
                        Clear Filters
                    </a>
                @else
                    <h3 class="text-xl font-black text-dark tracking-tight mb-2">Your Queue is Empty</h3>
                    <p class="text-dark/40 font-bold uppercase tracking-widest text-xs max-w-sm mx-auto leading-relaxed">
                        {{ ($isAvailable ?? true) ? 'Waiting for new heritage meal assignments from partners 🍳' : 'Set your status to online to start receiving delivery requests.' }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    {{-- Recent Deliveries History --}}
    <div class="bg-white rounded-[2.5rem] p-10 border border-black/5 shadow-sm">
        <div class="mb-10">
            <h4 class="text-2xl font-black text-dark tracking-tighter">Fulfillment History</h4>
            <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Your recently completed deliveries</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                        <th class="pb-6 pl-2">Order ID</th>
                        <th class="pb-6">Meal Details</th>
                        <th class="pb-6">Recipient</th>
                        <th class="pb-6">Logistics</th>
                        <th class="pb-6 pr-2 text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @forelse($recentDeliveries ?? [] as $order)
                    <tr class="group hover:bg-gray-50/50 transition-all">
                        <td class="py-8 pl-2">
                            <span class="text-xs font-black text-dark tracking-tighter uppercase">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="py-8">
                            <div class="flex items-center space-x-4">
                                @if($order->meal && $order->meal->mealImage)
                                <div class="w-10 h-10 rounded-xl overflow-hidden border border-black/5">
                                    <img src="{{ Str::startsWith($order->meal->mealImage, 'http') ? $order->meal->mealImage : asset('storage/' . $order->meal->mealImage) }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                @endif
                                <div>
                                    <p class="text-xs font-black text-dark">{{ $order->meal->mealName ?? 'Unknown' }}</p>
                                    <p class="text-[9px] font-bold text-dark/30 uppercase tracking-widest">{{ $order->mealPackage ?? 'Member' }} Pack</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-8">
                            <span class="text-xs font-bold text-dark/60 italic">{{ $order->user->name ?? 'Member' }}</span>
                        </td>
                        <td class="py-8">
                            <span class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest bg-green-500/10 text-green-600">
                                Delivered
                            </span>
                        </td>
                        <td class="py-8 pr-2 text-right">
                            <span class="text-[10px] font-black text-dark/20 uppercase tracking-tighter">{{ $order->updated_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-20 text-center">
                            <p class="text-dark/20 text-xs font-black uppercase tracking-[0.4em]">No delivery records found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection