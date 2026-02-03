@props(['order'])

<div class="bg-white rounded-[2.5rem] p-10 border border-black/5 shadow-sm hover:shadow-2xl transition-all duration-700 group flex flex-col h-full">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <span class="text-[10px] font-black text-dark/20 uppercase tracking-wider">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
        <span class="px-5 py-2.5 rounded-2xl text-[9px] font-black uppercase tracking-widest {{ $order->status_meta['bg'] }} {{ $order->status_meta['text'] }} shadow-sm">
            {{ $order->status_meta['label'] }}
        </span>
    </div>
    
    {{-- Meal Highlight --}}
    <div class="flex items-center space-x-6 mb-10 pb-10 border-b border-black/5">
        <div class="w-16 h-16 bg-dark/5 rounded-[1.2rem] overflow-hidden flex-shrink-0 shadow-inner group-hover:scale-110 transition-transform duration-700">
            @if($order->meal && $order->meal->mealImage)
                <img src="{{ Str::startsWith($order->meal->mealImage, 'http') ? $order->meal->mealImage : asset('storage/' . $order->meal->mealImage) }}" 
                     class="w-full h-full object-cover" loading="lazy">
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
    
    {{-- Delivery Notes (if any) --}}
    @if($order->deliveryNotes ?? false)
        <div class="p-4 bg-amber-50 rounded-xl border border-amber-200/50 mb-6">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-amber-500/20 text-amber-600 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[9px] font-black text-amber-600 uppercase tracking-widest mb-1">Special Instructions</p>
                    <p class="text-xs font-bold text-amber-800 leading-relaxed">{{ $order->deliveryNotes }}</p>
                </div>
            </div>
        </div>
    @endif

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
                @if($order->user->address ?? false)
                    <p class="text-[9px] font-medium text-dark/40 mt-1 truncate">{{ $order->user->address }}</p>
                @endif
            </div>
        </div>

        {{-- Quick Contact & Navigation --}}
        <div class="grid grid-cols-3 gap-2 pt-4">
            @if($order->user->phone ?? false)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->phone) }}" 
                   target="_blank"
                   class="flex items-center justify-center space-x-2 py-3 bg-green-500 text-white rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-green-500/20">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span class="text-[8px] font-black uppercase tracking-wider">WA</span>
                </a>
                <a href="tel:{{ $order->user->phone }}"
                   class="flex items-center justify-center space-x-2 py-3 bg-dark text-white rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-dark/20">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span class="text-[8px] font-black uppercase tracking-wider">Call</span>
                </a>
            @endif
            @if($order->user->address ?? false)
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($order->user->address) }}" 
                   target="_blank"
                   class="flex items-center justify-center space-x-2 py-3 bg-blue-500 text-white rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-blue-500/20 {{ ($order->user->phone ?? false) ? '' : 'col-span-3' }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    <span class="text-[8px] font-black uppercase tracking-wider">Navigate</span>
                </a>
            @endif
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
