@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-dark tracking-tighter">{{ $title_page }}</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Manage incoming meal requests and deliveries</p>
        </div>
    </div>
    
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl font-bold text-sm flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Orders Table --}}
    <div class="bg-white rounded-3xl border border-black/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-black/5">
                    <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em]">
                        <th class="px-8 py-6">Order ID</th>
                        <th class="px-8 py-6">Meal Details</th>
                        <th class="px-8 py-6">Customer</th>
                        <th class="px-8 py-6">Current Status</th>
                        <th class="px-8 py-6">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @forelse($orders as $order)
                    <tr class="group hover:bg-gray-50/50 transition-all">
                        <td class="px-8 py-8">
                            <span class="text-xs font-black text-dark tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <div class="mt-1 text-[9px] font-bold text-dark/40 uppercase tracking-widest">{{ $order->created_at->format('M d, H:i') }}</div>
                        </td>
                        <td class="px-8 py-8">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden shadow-sm">
                                    <img src="{{ Str::startsWith($order->meal->mealImage, 'http') ? $order->meal->mealImage : asset('storage/' . $order->meal->mealImage) }}" 
                                         class="w-full h-full object-cover" alt="">
                                </div>
                                <div>
                                    <p class="text-sm font-black text-dark">{{ $order->meal->mealName }}</p>
                                    <p class="text-[10px] font-bold text-dark/30 uppercase tracking-widest mt-1">{{ $order->mealPackage }} • {{ $order->foodTemperature }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-8">
                            <p class="text-xs font-bold text-dark">{{ $order->user->name }}</p>
                            @if($order->user->address)
                            <p class="text-[9px] font-medium text-dark/40 truncate max-w-[180px] mt-1">{{ $order->user->address }}</p>
                            @endif
                        </td>
                        <td class="px-8 py-8">
                             <span class="px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest 
                                {{ $order->status === 'preparation' ? 'bg-yellow-500/10 text-yellow-600' : '' }}
                                {{ $order->status === 'cooking' ? 'bg-orange-500/10 text-orange-600' : '' }}
                                {{ $order->status === 'ready' ? 'bg-blue-500/10 text-blue-600' : '' }}
                                {{ $order->status === 'picked_up' ? 'bg-purple-500/10 text-purple-600' : '' }}
                                {{ $order->status === 'delivered' || $order->status === 'completed' ? 'bg-green-500/10 text-green-600' : '' }}">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-8">
                            <form action="{{ route('partner.orders.update', $order->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="bg-[#F8F8F8] border border-black/5 text-dark text-[10px] font-black rounded-xl focus:ring-primary focus:border-dark block w-full p-3 uppercase tracking-widest cursor-pointer hover:bg-dark hover:text-white transition-all">
                                    <option value="preparation" {{ $order->status == 'preparation' ? 'selected' : '' }}>Preparation</option>
                                    <option value="cooking" {{ $order->status == 'cooking' ? 'selected' : '' }}>Cooking</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready for Pickup</option>
                                    <option value="picked_up" {{ $order->status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                    <option value="delivered" {{ ($order->status == 'delivered' || $order->status == 'completed') ? 'selected' : '' }}>Delivered</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-24 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-dark/5 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-dark/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <h3 class="text-dark font-black text-xl tracking-tight">No Orders Queue</h3>
                                <p class="text-dark/40 text-[10px] font-bold uppercase tracking-widest mt-2">New requests will appear here in real-time</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
        <div class="px-8 py-6 border-t border-black/5 bg-gray-50/30">
            {{ $orders->links('partials.custom-pagination') }}
        </div>
        @endif
    </div>
</div>
@endsection
