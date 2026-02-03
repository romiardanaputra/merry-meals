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

<div class="bg-white rounded-[2.5rem] p-10 border border-black/5 shadow-sm hover:shadow-2xl transition-all duration-700 group flex flex-col h-full">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <span class="text-[10px] font-black text-dark/20 uppercase tracking-wider">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
        <span class="px-5 py-2.5 rounded-2xl text-[9px] font-black uppercase tracking-widest {{ $status['bg'] }} {{ $status['text'] }} shadow-sm">
            {{ $status['label'] }}
        </span>
    </div>
    
    {{-- Meal Highlight --}}
    <div class="flex items-center space-x-6 mb-10 pb-10 border-b border-black/5">
        <div class="w-16 h-16 bg-dark/5 rounded-[1.2rem] overflow-hidden flex-shrink-0 shadow-inner group-hover:scale-110 transition-transform duration-700">
            @if($order->meal && $order->meal->mealImage)
                <img src="{{ Str::startsWith($order->meal->mealImage, 'http') ? $order->meal->mealImage : asset('storage/' . $order->meal->mealImage) }}" 
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-dark/10">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="text-xl font-black text-dark tracking-tight leading-none group-hover:text-primary transition-colors">{{ $order->meal->mealName ?? 'Heritage Meal' }}</h4>
            <div class="flex items-center space-x-2 mt-3">
                 <span class="text-[9px] font-black uppercase tracking-widest text-dark/30">{{ $order->mealPackage ?? 'Standard' }}</span>
                 <span class="w-1.5 h-1.5 rounded-full bg-black/5"></span>
                 <span class="text-[9px] font-black uppercase tracking-widest text-primary italic">{{ $order->foodTemperature ?? 'Hot' }}</span>
            </div>
        </div>
    </div>
    
    {{-- Logistics --}}
    <div class="space-y-6 flex-1">
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 bg-[#222222] text-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[9px] font-black text-dark/20 uppercase tracking-[0.2em] mb-1">Pick up from</p>
                <p class="text-sm font-black text-dark truncate">{{ $order->partner->restaurantName ?? 'Partner Kitchen' }}</p>
            </div>
        </div>
        
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[9px] font-black text-dark/20 uppercase tracking-[0.2em] mb-1">Deliver to</p>
                <p class="text-sm font-black text-dark truncate">{{ $order->user->name ?? 'Community Member' }}</p>
            </div>
        </div>
    </div>
    
    {{-- Operations --}}
    <div class="mt-12 pt-10 border-t border-black/5">
        @if($order->status === 'assigned')
            <form action="{{ route('driver.delivery.status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="picked_up">
                <button type="submit" class="w-full py-5 bg-dark text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-dark/10">
                    MARK AS PICKED UP
                </button>
            </form>
        @elseif($order->status === 'picked_up')
             <form action="{{ route('driver.delivery.status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="in_transit">
                <button type="submit" class="w-full py-5 bg-primary text-dark rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20">
                    START TRANSIT
                </button>
            </form>
        @elseif($order->status === 'in_transit')
            <form action="{{ route('driver.delivery.status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="delivered">
                <button type="submit" class="w-full py-5 bg-green-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-green-500/20">
                    COMPLETE DELIVERY
                </button>
            </form>
        @else
            <div class="w-full py-5 bg-green-500/10 text-green-600 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-center border border-green-500/20">
                ✓ Order Fulfilled
            </div>
        @endif
        <div class="mt-6 flex items-center justify-center space-x-2 text-[9px] font-bold text-dark/20 uppercase tracking-widest italic">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Handled {{ $order->created_at->diffForHumans() }}</span>
        </div>
    </div>
</div>
