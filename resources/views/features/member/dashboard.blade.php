@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
        .text-h6 { font-size: 1.25rem; font-weight: 800; }
        .text-p  { font-size: 1rem; font-weight: 500; line-height: 1.6; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter p-4 sm:p-8 lg:p-12 overflow-x-hidden">
    <!-- Mobile-First Header -->
    @include('features.member.partials.header')

    <!-- Content Grid -->
    <div class="max-w-[1800px] mx-auto grid grid-cols-12 gap-8 lg:gap-12">
        <!-- Main Panel -->
        <div class="col-span-12 lg:col-span-9 space-y-8 lg:space-y-12">
            
            <!-- Stat Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8">
                <!-- Total Orders -->
                <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-dark/30">Total Orders</span>
                            <h2 class="text-3xl font-black text-dark tracking-tighter">{{ $stats['total_orders'] }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-dark rounded-2xl flex items-center justify-center text-white shadow-lg shadow-dark/20">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-[10px] font-bold text-primary uppercase">All-time activity</span>
                    </div>
                </div>

                <!-- Active Deliveries -->
                <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-dark/30">On the Way</span>
                            <h2 class="text-3xl font-black text-dark tracking-tighter">{{ $stats['active_deliveries'] }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-dark shadow-lg shadow-primary/20">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-[10px] font-bold text-dark/40 uppercase">Live tracking</span>
                    </div>
                </div>

                <!-- Delivered -->
                <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-dark/30">Successful</span>
                            <h2 class="text-3xl font-black text-dark tracking-tighter">{{ $stats['delivered_orders'] }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-500/20">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-[10px] font-bold text-dark/40 uppercase">Meals received</span>
                    </div>
                </div>

                <!-- Surveys -->
                <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-dark/30">Surveys</span>
                            <h2 class="text-3xl font-black text-dark tracking-tighter">{{ $stats['pending_surveys'] }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-dark/5 rounded-2xl flex items-center justify-center text-dark/40 group-hover:bg-dark group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-[10px] font-bold text-primary uppercase">Pending feedback</span>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="bg-white rounded-[2.5rem] p-10 border border-black/5 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h4 class="text-h4 text-dark tracking-tighter">Recent Deliveries</h4>
                        <p class="text-dark/40 text-xs font-bold uppercase tracking-widest mt-1 italic">Tracking your nutrition</p>
                    </div>
                    <a href="{{ route('meal.menu') }}" class="px-6 py-3 bg-dark/5 hover:bg-dark hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">New Order</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                                <th class="pb-6 pl-2">Order ID</th>
                                <th class="pb-6">Meal Pack</th>
                                <th class="pb-6">Partner</th>
                                <th class="pb-6">Status</th>
                                <th class="pb-6 pr-2 text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @forelse($orders as $order)
                            <tr class="group hover:bg-dark/5 transition-all">
                                <td class="py-8 pl-2">
                                    <span class="text-xs font-black text-dark uppercase tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-8">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-dark/5 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-dark/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 16v2m3-6v6m3-8v8m9-10.1c0 6.6-1.5 10.1-4.5 10.1s-4.5-3.5-4.5-10.1c0-5.6-7.1-5.6-7.1 0 0 6.6-1.5 10.1-4.5 10.1s-4.5-3.5-4.5-10.1c0-10.1 7.1-10.1 12.5-10.1s12.5 0 12.5 10.1z" /></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-dark">{{ $order->meal->mealName }}</p>
                                            <p class="text-[10px] font-bold text-dark/30 uppercase tracking-widest">{{ $order->mealPackage }} Pack</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-8">
                                    <span class="text-xs font-bold text-dark/60">{{ $order->partner->restaurantName }}</span>
                                </td>
                                <td class="py-8">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['bg' => 'bg-dark/5', 'text' => 'text-dark/40', 'label' => 'Processing'],
                                            'assigned' => ['bg' => 'bg-primary/10', 'text' => 'text-primary', 'label' => 'Out for Delivery'],
                                            'delivered' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-600', 'label' => 'Received'],
                                        ][$order->status] ?? ['bg' => 'bg-dark/5', 'text' => 'text-dark/40', 'label' => $order->status];
                                    @endphp
                                    <span class="px-4 py-1.5 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} rounded-full text-[9px] font-black uppercase tracking-widest">
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
                                    <a href="{{ route('meal.menu') }}" class="mt-4 inline-block text-primary font-bold hover:underline italic">Start ordering today →</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Side Panel -->
        <aside class="col-span-12 lg:col-span-3 space-y-8 lg:space-y-12">
            <!-- Impact Card -->
            <div class="bg-[#FF7B54] rounded-[2.5rem] p-10 text-white shadow-2xl shadow-primary/30 relative overflow-hidden group">
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <span class="text-[9px] font-black uppercase tracking-[0.4em] opacity-60">Your Impact</span>
                        <h4 class="text-h4 mt-6 tracking-tight leading-tight">Staying Healthy Together</h4>
                    </div>
                    <div class="mt-12">
                        <p class="text-sm opacity-90 font-medium leading-relaxed italic">"Every healthy meal is a step towards a vibrant life."</p>
                        <div class="mt-10 pt-10 border-t border-white/10 flex items-center justify-between">
                            <div>
                                <p class="text-[24px] font-black leading-none">{{ $stats['delivered_orders'] }}</p>
                                <p class="text-[9px] font-black uppercase tracking-widest opacity-60 mt-1">Meals Shared</p>
                            </div>
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-16 -top-16 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-1000"></div>
            </div>

            <!-- Support / Help -->
            <div class="bg-white rounded-xl p-8 border border-black/5 space-y-8 shadow-sm">
                <h6 class="text-[12px] font-black text-dark uppercase tracking-[0.3em]">Support Center</h6>
                <div class="space-y-4">
                    <div class="p-4 bg-dark/5 rounded-2xl flex items-center space-x-4 group cursor-pointer hover:bg-dark hover:text-white transition-all">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest">Help Desk</span>
                    </div>
                    <div class="p-4 bg-dark/5 rounded-2xl flex items-center space-x-4 group cursor-pointer hover:bg-dark hover:text-white transition-all text-dark">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest">Emergency</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Floating Order Button -->
    <div class="fixed bottom-8 right-8 z-[100]">
        <a href="{{ route('meal.menu') }}" class="w-14 h-14 bg-dark text-white rounded-xl shadow-2xl hover:scale-110 transition-all flex items-center justify-center group">
            <svg class="w-6 h-6 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        </a>
    </div>
</main>
@endsection