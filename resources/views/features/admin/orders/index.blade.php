@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
        <div>
            <h2 class="text-2xl font-black text-dark tracking-tight">Order Oversight</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-[0.2em] mt-1">Monitor fulfillment and assign delivery riders</p>
        </div>
    </div>

    {{-- Header Row (Desktop) --}}
    <div class="hidden lg:grid grid-cols-12 px-8 py-3 bg-gray-50/50 rounded-xl mb-4">
        <div class="col-span-2 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Order Info</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Member</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Partner</div>
        <div class="col-span-2 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Status</div>
        <div class="col-span-2 text-right text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Assignment</div>
    </div>

    <div class="space-y-4">
        @forelse($orders as $order)
        <div class="bg-white rounded-2xl p-6 lg:p-0 lg:px-8 lg:py-6 flex flex-col lg:grid lg:grid-cols-12 items-center gap-6 lg:gap-0 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 group border border-transparent hover:border-primary/10">
            {{-- Order Info --}}
            <div class="lg:col-span-2 w-full">
                <div class="flex flex-col">
                    <span class="text-xs font-black text-dark/20 uppercase tracking-widest mb-1">ID</span>
                    <span class="text-sm font-black text-dark tracking-tighter">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            {{-- Member --}}
            <div class="lg:col-span-3 w-full">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/5 flex items-center justify-center flex-shrink-0">
                        <span class="text-primary font-black text-sm uppercase">{{ substr($order->user->name, 0, 1) }}</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-sm font-black text-dark tracking-tight truncate">{{ $order->user->name }}</span>
                        <span class="text-[10px] font-bold text-dark/30 truncate">{{ $order->user->email }}</span>
                    </div>
                </div>
            </div>

            {{-- Partner --}}
            <div class="lg:col-span-3 w-full">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-dark/5 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-dark/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <span class="text-sm font-black text-dark/80 tracking-tight truncate">{{ $order->partner->restaurantName }}</span>
                </div>
            </div>

            {{-- Status --}}
            <div class="lg:col-span-2 w-full">
                @php
                    $statusMap = [
                        'preparation' => 'bg-orange-100 text-orange-700 border-orange-200',
                        'assigned' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'delivery' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                        'delivered' => 'bg-green-100 text-green-700 border-green-200',
                        'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                    ];
                    $statusColor = $statusMap[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                @endphp
                <span class="px-4 py-1.5 {{ $statusColor }} text-[8px] font-black uppercase rounded-lg tracking-[0.2em] border shadow-sm">
                    {{ $order->status }}
                </span>
            </div>

            {{-- Assignment --}}
            <div class="lg:col-span-2 w-full">
                <div class="flex items-center lg:justify-end">
                    @if($order->status === 'preparation')
                    <form action="{{ route('admin.orders.assign', $order->id) }}" method="POST" class="flex items-center space-x-2 w-full lg:w-auto">
                        @csrf
                        <select name="volunteerID" class="text-[9px] font-black uppercase tracking-widest bg-dark/5 border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all p-3 flex-1 lg:w-32">
                            <option value="" disabled selected>Rider</option>
                            @foreach($volunteers as $rider)
                                <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-10 h-10 bg-dark text-white rounded-xl shadow-lg shadow-dark/10 hover:scale-105 active:scale-95 transition-all flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 5l7 7-7 7M5 5l7 7-7 7" /></svg>
                        </button>
                    </form>
                    @elseif($order->volunteerID)
                    <div class="flex items-center space-x-3 bg-primary/5 px-4 py-2 rounded-2xl border border-primary/10">
                        <div class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center flex-shrink-0">
                            <span class="text-primary font-black text-[10px] uppercase">{{ substr($order->volunteer->name, 0, 1) }}</span>
                        </div>
                        <span class="text-[11px] font-black text-dark truncate">{{ $order->volunteer->name }}</span>
                    </div>
                    @else
                    <span class="text-[10px] font-black text-dark/20 uppercase tracking-widest italic animate-pulse">Waiting for Rider...</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-black/5">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <p class="text-sm font-black text-dark/20 uppercase tracking-[0.3em]">No active orders found</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8 px-4">
        {{ $orders->links('partials.custom-pagination') }}
    </div>
</div>
@endsection
