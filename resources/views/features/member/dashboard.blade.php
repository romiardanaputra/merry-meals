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
    <header x-data="{ mobileMenuOpen: false }" class="max-w-[1800px] mx-auto flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-12 px-2">
        <!-- Sidebar Drawer (Mobile Only) -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-72 bg-white shadow-2xl z-[150] lg:hidden flex flex-col p-8 border-r border-black/5"
             @click.away="mobileMenuOpen = false">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                    <span class="font-black text-dark uppercase tracking-tighter">Merry Meals</span>
                </div>
                <button @click="mobileMenuOpen = false" class="text-dark/40 hover:text-dark">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <nav class="flex-1 space-y-4">
                <a href="{{ route('member.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('member.dashboard') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">Overview</a>
                <a href="{{ route('meal.menu') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('meal.menu') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">Browse Menu</a>
                <a href="{{ route('member.survey') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('member.survey') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">Support Survey</a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('profile.edit') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">My Profile</a>
            </nav>

            <div class="pt-8 border-t border-black/5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10">Logout</button>
                </form>
            </div>
        </div>

        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-dark/20 backdrop-blur-sm z-[140] lg:hidden"
             @click="mobileMenuOpen = false"></div>

        <!-- Logo & Mobile Actions -->
        <div class="flex items-center justify-between w-full lg:w-auto">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm p-2">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-tight text-dark uppercase leading-none">Merry Meals</h1>
                    <div class="flex items-center space-x-2 mt-1">
                        <p class="text-[9px] font-bold text-primary tracking-widest uppercase italic">Welcome back,</p>
                        <span class="px-2 py-0.5 bg-dark text-white text-[8px] font-black uppercase rounded-md tracking-widest">Member</span>
                    </div>
                </div>
            </div>
            
            <div class="lg:hidden flex items-center space-x-3">
                <button @click="mobileMenuOpen = true" class="w-11 h-11 rounded-xl bg-white flex items-center justify-center shadow-sm border border-black/5 text-dark active:scale-95 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                </button>
            </div>
        </div>

        <!-- Pill Navigation -->
        <nav x-data="{ 
                activeIndex: {{ [
                    'member.dashboard' => 0,
                    'meal.menu' => 1,
                    'member.survey' => 2,
                    'profile.edit' => 3
                ][Route::currentRouteName()] ?? 0 }},
                get sliderStyle() {
                    const el = this.$refs['navItem' + this.activeIndex];
                    if (!el) return '';
                    return `left: ${el.offsetLeft}px; width: ${el.offsetWidth}px;`;
                }
             }" 
             x-init="window.addEventListener('resize', () => { $data.activeIndex = $data.activeIndex })"
             class="hidden lg:flex items-center bg-white p-1.5 rounded-full shadow-sm border border-black/5 relative overflow-hidden h-12">
            
            <div class="absolute top-1.5 bottom-1.5 bg-dark rounded-full shadow-lg shadow-dark/20 transition-all duration-500 ease-out z-0" 
                 :style="sliderStyle"></div>
            
            <div class="flex items-center space-x-1 min-w-max px-1">
                @php
                    $navLinks = [
                        ['route' => 'member.dashboard', 'label' => 'Overview', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'meal.menu', 'label' => 'Browse Menu', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['route' => 'member.survey', 'label' => 'Feedback', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ];
                @endphp

                @foreach($navLinks as $index => $link)
                    <a href="{{ route($link['route']) }}" 
                       x-ref="navItem{{ $index }}"
                       class="flex items-center space-x-2 px-6 py-2 rounded-full font-black text-[11px] uppercase tracking-wider transition-all duration-500 whitespace-nowrap relative z-10 
                       {{ Request::routeIs($link['route']) ? 'text-white' : 'text-dark/40 hover:text-dark' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $link['icon'] }}" /></svg>
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </nav>

        <div class="hidden sm:flex items-center space-x-6">
            <div class="flex items-center space-x-4 pl-4 border-l border-black/10">
                <div class="text-right hidden md:block">
                    <p class="text-xs font-black text-dark leading-none">{{ auth()->user()->username }}</p>
                    <p class="text-[9px] font-bold text-dark/30 uppercase tracking-widest leading-loose">Member</p>
                </div>
                <div class="w-11 h-11 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                    <span class="text-dark font-black text-sm uppercase">{{ substr(auth()->user()->username, 0, 1) }}</span>
                </div>
            </div>
        </div>
    </header>

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