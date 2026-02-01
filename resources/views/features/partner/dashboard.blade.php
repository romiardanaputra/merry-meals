@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter">
    <!-- Desktop Sidebar -->
    @include('features.partner.partials.sidebar')

    <!-- Mobile Header -->
    <header x-data="{ mobileMenuOpen: false }" class="lg:hidden bg-white border-b border-black/5 p-4 sticky top-0 z-40">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-xl flex items-center justify-center text-white">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                </div>
                <span class="font-black text-dark tracking-tight uppercase">Merry Meal</span>
            </div>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-dark/60 hover:text-dark">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" 
             style="display: none;"
             class="fixed inset-0 z-50 flex">
            <div class="fixed inset-0 bg-dark/20 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-[#222222] p-6 pb-4">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                        </div>
                        <span class="text-white font-black tracking-widest uppercase text-xs">Partner</span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="text-white/40 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <nav class="space-y-2 flex-1">
                    <a href="{{ route('partner.index') }}" class="block px-4 py-3 bg-primary text-dark rounded-xl font-bold text-sm tracking-tight">Dashboard</a>
                    <a href="{{ route('meal.index') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">Meals</a>
                    <a href="{{ route('partner.orders.index') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">Orders</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">Profile</a>
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

    <!-- Main Content Area -->
    <div class="lg:pl-[320px]">
        <div class="max-w-[1800px] mx-auto p-4 md:p-8 lg:p-12 space-y-12">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-h2 text-dark tracking-tighter">{{ $partner->restaurantName }}</h1>
                    <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Partner Dashboard • {{ $title_page }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-4 py-2 bg-green-500/10 text-green-600 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                        <span class="block w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        Kitchen Open
                    </span>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Total Orders -->
                <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-dark/30">Total Orders</span>
                            <h2 class="text-4xl font-black text-dark tracking-tighter">{{ $stats['total_orders'] }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-dark/5 rounded-2xl flex items-center justify-center text-dark group-hover:bg-dark group-hover:text-white transition-all duration-300">
                           <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        </div>
                    </div>
                </div>

                <!-- Preparing -->
                <div class="bg-primary text-dark rounded-[2rem] p-8 border border-black/5 shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all duration-500 relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-6 relative z-10">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider opacity-60">Preparing Now</span>
                            <h2 class="text-4xl font-black tracking-tighter">{{ $stats['preparing'] }}</h2>
                        </div>
                         <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                           <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                     <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                </div>

                <!-- Completed -->
                 <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black uppercase tracking-wider text-dark/30">Completed</span>
                            <h2 class="text-4xl font-black text-dark tracking-tighter">{{ $stats['completed'] }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-600 group-hover:bg-green-500 group-hover:text-white transition-all duration-300">
                           <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-black/5 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h4 class="text-2xl font-black text-dark tracking-tighter">Incoming Orders</h4>
                        <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Latest requests from members</p>
                    </div>
                    <a href="{{ route('partner.orders.index') }}" class="px-6 py-3 bg-dark/5 hover:bg-dark hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                                <th class="pb-6 pl-2">Order ID</th>
                                <th class="pb-6">Meal</th>
                                <th class="pb-6">Customer</th>
                                <th class="pb-6">Status</th>
                                <th class="pb-6 pr-2 text-right">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @forelse($orders as $order)
                            <tr class="group hover:bg-dark/5 transition-all">
                                <td class="py-6 pl-2">
                                    <span class="text-xs font-black text-dark uppercase tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center space-x-3">
                                        @if($order->meal->mealImage)
                                        <img src="{{ asset('storage/' . $order->meal->mealImage) }}" class="w-8 h-8 rounded-lg object-cover" alt="">
                                        @endif
                                        <span class="text-xs font-bold text-dark">{{ $order->meal->mealName }}</span>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <span class="text-xs font-bold text-dark/60">{{ $order->user->name }}</span>
                                </td>
                                <td class="py-6">
                                    <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest 
                                        {{ $order->status === 'preparation' ? 'bg-yellow-500/10 text-yellow-600' : '' }}
                                        {{ $order->status === 'assigned' ? 'bg-blue-500/10 text-blue-600' : '' }}
                                        {{ $order->status === 'delivered' ? 'bg-green-500/10 text-green-600' : '' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-6 pr-2 text-right">
                                    <span class="text-[10px] font-bold text-dark/30">{{ $order->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <p class="text-dark/20 text-xs font-black uppercase tracking-[0.4em]">No active orders</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection