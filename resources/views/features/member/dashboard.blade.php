@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="space-y-12">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-dark tracking-tighter">Member Dashboard</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Welcome back • Your Nutrition Overview</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('member.meals.menu') }}" 
               class="px-8 py-4 bg-primary text-dark rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/20">
                Order New Meal
            </a>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
        <x-dashboard.stat-card 
            label="Total Orders" 
            :value="$stats['total_orders']" 
            color="primary"
            icon="shopping-bag"
        />
        <x-dashboard.stat-card 
            label="On the Way" 
            :value="$stats['active_deliveries']" 
            color="warning"
            icon="truck"
        />
        <x-dashboard.stat-card 
            label="Successful" 
            :value="$stats['delivered_orders']" 
            color="success"
            icon="check-circle"
        />
        <x-dashboard.stat-card 
            label="Pending Feedback" 
            :value="$stats['pending_surveys']" 
            color="dark"
            icon="heart"
        />
    </div>

    {{-- Content Area --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Recent Orders --}}
        <div class="lg:col-span-2 bg-white rounded-3xl p-8 md:p-10 border border-black/5 shadow-sm">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h4 class="text-2xl font-black text-dark tracking-tighter">Recent Deliveries</h4>
                    <p class="text-dark/40 text-[10px] font-bold uppercase tracking-widest mt-1">Tracking your nutrition</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                            <th class="pb-6 pl-2">Order ID</th>
                            <th class="pb-6">Meal Details</th>
                            <th class="pb-6">Partner</th>
                            <th class="pb-6">Status</th>
                            <th class="pb-6 pr-2 text-right">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5">
                        @forelse($orders as $order)
                        <tr class="group hover:bg-gray-50/50 transition-all">
                            <td class="py-8 pl-2">
                                <span class="text-xs font-black text-dark tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="py-8">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-dark/5 rounded-xl flex items-center justify-center overflow-hidden">
                                        @if($order->meal->mealImage)
                                            <img src="{{ Str::startsWith($order->meal->mealImage, 'http') ? $order->meal->mealImage : asset('storage/' . $order->meal->mealImage) }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-dark/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 16v2m3-6v6m3-8v8m9-10.1c0 6.6-1.5 10.1-4.5 10.1s-4.5-3.5-4.5-10.1c0-5.6-7.1-5.6-7.1 0 0 6.6-1.5 10.1-4.5 10.1s-4.5-3.5-4.5-10.1c0-10.1 7.1-10.1 12.5-10.1s12.5 0 12.5 10.1z" /></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-dark">{{ $order->meal->mealName }}</p>
                                        <p class="text-[9px] font-bold text-dark/30 uppercase tracking-widest">{{ $order->mealPackage }} Pack</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-8">
                                <span class="text-xs font-bold text-dark/60">{{ $order->partner->restaurantName }}</span>
                            </td>
                            <td class="py-8">
                                @php
                                    $statusConfig = [
                                        'pending' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-600', 'label' => 'Processing'],
                                        'assigned' => ['bg' => 'bg-primary/10', 'text' => 'text-primary', 'label' => 'Out for Delivery'],
                                        'picked_up' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-600', 'label' => 'Picked Up'],
                                        'delivered' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-600', 'label' => 'Received'],
                                        'completed' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-600', 'label' => 'Completed'],
                                    ][$order->status] ?? ['bg' => 'bg-dark/5', 'text' => 'text-dark/40', 'label' => str_replace('_', ' ', $order->status)];
                                @endphp
                                <span class="px-4 py-2 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} rounded-full text-[9px] font-black uppercase tracking-widest">
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>
                            <td class="py-8 pr-2 text-right">
                                <span class="text-[10px] font-black text-dark/20 uppercase tracking-tighter">{{ $order->created_at->format('d M, Y') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <p class="text-dark/20 text-xs font-black uppercase tracking-[0.4em]">No recent orders found</p>
                                <a href="{{ route('member.meals.menu') }}" class="mt-4 inline-block text-primary font-bold hover:underline italic text-xs">Start ordering today →</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Impact & Actions --}}
        <div class="space-y-8">
            <div class="bg-primary rounded-[2.5rem] p-10 text-dark shadow-xl shadow-primary/10 relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="text-[9px] font-black uppercase tracking-[0.4em] opacity-40">Your Impact</span>
                    <h4 class="text-2xl font-black mt-4 leading-tight tracking-tight">Staying healthy together for a better future.</h4>
                    
                    <div class="mt-12 pt-10 border-t border-dark/5 flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-black leading-none">{{ $stats['delivered_orders'] }}</p>
                            <p class="text-[9px] font-black uppercase tracking-widest opacity-40 mt-1">Meals Shared</p>
                        </div>
                        <div class="w-12 h-12 bg-dark rounded-2xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($stats['pending_surveys'] > 0)
            <div class="bg-dark rounded-3xl p-8 text-white relative overflow-hidden">
                <h6 class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 mb-4">Feedback Required</h6>
                <p class="text-sm font-medium leading-relaxed mb-8">You have {{ $stats['pending_surveys'] }} pending surveys. Help us improve your experience!</p>
                <a href="{{ route('member.survey') }}" class="inline-block px-8 py-4 bg-primary text-dark rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all">Submit Feedback</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection