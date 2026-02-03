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
    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-2xl font-black text-dark tracking-tighter">Active Queue</h4>
                <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Real-time delivery fulfillment</p>
            </div>
            @if(isset($activeDeliveries) && count($activeDeliveries) > 0)
                <span class="px-4 py-2 bg-primary/10 text-primary rounded-xl text-[10px] font-black uppercase tracking-widest">
                    {{ count($activeDeliveries) }} Orders
                </span>
            @endif
        </div>

        @if(isset($activeDeliveries) && count($activeDeliveries) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($activeDeliveries as $order)
                    @include('features.rider.partials.delivery-card', ['order' => $order])
                @endforeach
            </div>
        @else
            <div class="bg-white p-20 rounded-[3rem] border border-black/5 text-center shadow-sm">
                <div class="w-24 h-24 bg-dark/5 rounded-full flex items-center justify-center text-dark/10 mx-auto mb-8">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-dark tracking-tight mb-3">Your Queue is Empty</h3>
                <p class="text-dark/40 font-bold uppercase tracking-widest text-xs max-w-sm mx-auto leading-relaxed">
                    {{ ($isAvailable ?? true) ? 'Waiting for new heritage meal assignments from partners 🍳' : 'Set your status to online to start receiving delivery requests.' }}
                </p>
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