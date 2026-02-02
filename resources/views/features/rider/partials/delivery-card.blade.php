{{-- Active Delivery Card Component --}}
@props(['order'])

@php
    $statusColors = [
        'assigned' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-600', 'label' => 'Assigned'],
        'picked_up' => ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-600', 'label' => 'Picked Up'],
        'in_transit' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-600', 'label' => 'In Transit'],
        'delivered' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-600', 'label' => 'Delivered'],
    ];
    $status = $statusColors[$order->status] ?? $statusColors['assigned'];
@endphp

<div class="bg-white rounded-xl p-6 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-300">
    {{-- Header with Order ID and Status --}}
    <div class="flex items-center justify-between mb-6">
        <span class="text-xs font-black text-dark uppercase tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $status['bg'] }} {{ $status['text'] }}">
            {{ $status['label'] }}
        </span>
    </div>
    
    {{-- Meal Info --}}
    <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-black/5">
        @if($order->meal && $order->meal->mealImage)
            <img src="{{ asset('storage/' . $order->meal->mealImage) }}" 
                 class="w-16 h-16 rounded-xl object-cover shadow-lg" 
                 alt="{{ $order->meal->mealName ?? 'Meal' }}">
        @else
            <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center">
                <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        @endif
        <div class="flex-1 min-w-0">
            <h4 class="text-sm font-black text-dark truncate">{{ $order->meal->mealName ?? 'Unknown Meal' }}</h4>
            <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest">{{ $order->mealPackage ?? 'Standard' }} • {{ $order->foodTemperature ?? 'Hot' }}</p>
        </div>
    </div>
    
    {{-- Locations --}}
    <div class="space-y-4 mb-6">
        {{-- Pickup Location --}}
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[9px] font-black text-dark/30 uppercase tracking-widest">Pickup</p>
                <p class="text-xs font-bold text-dark truncate">{{ $order->partner->restaurantName ?? 'Restaurant' }}</p>
            </div>
        </div>
        
        {{-- Delivery Location --}}
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-green-500/10 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[9px] font-black text-dark/30 uppercase tracking-widest">Deliver To</p>
                <p class="text-xs font-bold text-dark truncate">{{ $order->user->name ?? 'Member' }}</p>
            </div>
        </div>
    </div>
    
    {{-- Action Buttons --}}
    <div class="flex space-x-3">
        @if($order->status === 'assigned')
            <form action="{{ route('driver.delivery.status', $order->id) }}" method="POST" class="flex-1">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="picked_up">
                <button type="submit" class="w-full py-3 bg-dark text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-[1.02] transition-all shadow-lg shadow-dark/20">
                    Mark Picked Up
                </button>
            </form>
        @elseif($order->status === 'picked_up')
            <form action="{{ route('driver.delivery.status', $order->id) }}" method="POST" class="flex-1">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="in_transit">
                <button type="submit" class="w-full py-3 bg-purple-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-[1.02] transition-all shadow-lg shadow-purple-500/20">
                    Start Delivery
                </button>
            </form>
        @elseif($order->status === 'in_transit')
            <form action="{{ route('driver.delivery.status', $order->id) }}" method="POST" class="flex-1">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="delivered">
                <button type="submit" class="w-full py-3 bg-green-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-[1.02] transition-all shadow-lg shadow-green-500/20">
                    Mark Delivered
                </button>
            </form>
        @else
            <div class="flex-1 py-3 bg-green-500/10 text-green-600 rounded-xl text-[10px] font-black uppercase tracking-widest text-center">
                ✓ Completed
            </div>
        @endif
    </div>
    
    {{-- Time --}}
    <div class="mt-4 pt-4 border-t border-black/5 flex items-center justify-between">
        <span class="text-[9px] font-bold text-dark/30 uppercase tracking-widest">Order Time</span>
        <span class="text-[10px] font-bold text-dark/60">{{ $order->created_at->diffForHumans() }}</span>
    </div>
</div>
