@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
        .text-h6 { font-size: 1.25rem; font-weight: 800; }
        .text-p  { font-size: 1rem; font-weight: 500; line-height: 1.6; }
        
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
                <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('admin.index') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">
                    User Management
                </a>
                <a href="{{ route('admin.partners.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('admin.partners.index') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">
                    Partner Management
                </a>
                <a href="{{ route('donator.list') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('donator.list') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">
                    Donation History
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('admin.orders.index') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">
                    Order Oversight
                </a>
                <a href="{{ route('meal.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('meal.index') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">
                    Meal Inventory
                </a>
                <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ Request::routeIs('admin.reports.index') ? 'bg-dark text-white' : 'text-dark/40 hover:bg-dark/5' }} font-bold text-sm transition-all">
                    Reports & Analytics
                </a>
            </nav>

            <div class="pt-8 border-t border-black/5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10">
                        Logout
                    </button>
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
                        <p class="text-[9px] font-bold text-primary tracking-widest uppercase">Meals on Wheels</p>
                        <span class="px-2 py-0.5 bg-dark text-white text-[8px] font-black uppercase rounded-md tracking-widest">Admin</span>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <div class="lg:hidden flex items-center space-x-3">
                <button @click="mobileMenuOpen = true" class="w-11 h-11 rounded-xl bg-white flex items-center justify-center shadow-sm border border-black/5 text-dark active:scale-95 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                </button>
            </div>
        </div>

        <!-- Pill Navigation - Hidden on Mobile -->
        <nav x-data="{ 
                activeIndex: {{ [
                    'admin.index' => 0,
                    'admin.partners.index' => 1,
                    'donator.list' => 2,
                    'admin.orders.index' => 3,
                    'meal.index' => 4,
                    'admin.reports.index' => 5
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
                        ['route' => 'admin.index', 'label' => 'Users', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['route' => 'admin.partners.index', 'label' => 'Partners', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['route' => 'donator.list', 'label' => 'Donations', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['route' => 'admin.orders.index', 'label' => 'Orders', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                        ['route' => 'meal.index', 'label' => 'Inventory', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                        ['route' => 'admin.reports.index', 'label' => 'Reports', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
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

        <!-- Profile / Notifications - Hidden on small mobile -->
        <div class="hidden sm:flex items-center space-x-6">
            <button class="w-11 h-11 rounded-xl bg-white flex items-center justify-center shadow-sm border border-black/5 text-dark/40 hover:text-dark transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            </button>
            <div class="flex items-center space-x-4 pl-4 border-l border-black/10">
                <div class="text-right hidden md:block">
                    <p class="text-xs font-black text-dark leading-none">{{ auth()->user()->username }}</p>
                    <p class="text-[9px] font-bold text-dark/30 uppercase tracking-widest">Administrator</p>
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
            
            @if(Request::routeIs('admin.index'))
            <!-- Stat Cards Row - Stacked on Mobile -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10 border-t lg:border-none pt-8 lg:pt-0">
                @include('features.admin.partials.stat-card', ['label' => 'Total Users', 'value' => \App\Models\User::count(), 'percentage' => 12, 'color' => 'primary'])
                @include('features.admin.partials.stat-card', ['label' => 'Total Donations', 'value' => '$'.number_format(\App\Models\Donation::sum('donationAmount')), 'percentage' => 15, 'color' => 'black'])
                @include('features.admin.partials.stat-card', ['label' => 'Meals Delivered', 'value' => '2,430', 'percentage' => 40, 'color' => 'primary'])
            </div>

            <!-- Activity Row -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10">
                <div class="lg:col-span-8">
                    @include('features.admin.partials.activity-chart')
                </div>
                <div class="lg:col-span-4 bg-[#FF7B54] rounded-xl p-8 lg:p-10 text-white shadow-xl shadow-primary/20 relative overflow-hidden group">
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <span class="text-[9px] font-black uppercase tracking-[0.3em] opacity-60">Impact Report</span>
                            <h4 class="text-h4 mt-4 tracking-tight leading-tight">Merry Meal 2026</h4>
                        </div>
                        <div class="mt-8">
                            <p class="text-xs opacity-80 font-medium">Over 20k+ lives touched. Keep up the amazing work!</p>
                            <button class="mt-8 w-full py-4 bg-white text-dark rounded-xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-xl">Full Report</button>
                        </div>
                    </div>
                    <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>
                </div>
            </div>
            @endif

            <!-- Data Content (Table or Form) -->
            <div class="animate-on-scroll">
                @yield('dashboard_admin')
            </div>
        </div>

        <!-- Right Side Panel - Stacked below on mobile/tablet -->
        <aside class="col-span-12 lg:col-span-3 space-y-8 lg:space-y-12">
            <!-- Summary Stats -->
            <div class="bg-white rounded-xl p-8 lg:p-10 shadow-sm border border-black/5 space-y-8">
                <div class="flex justify-between items-center px-1">
                    <h6 class="text-[13px] font-black text-dark uppercase tracking-widest">System Status</h6>
                    <button class="w-7 h-7 rounded-xl bg-dark/5 flex items-center justify-center text-dark/40"><svg class="w-4 h-4 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg></button>
                </div>
                
                <div class="space-y-6">
                    @foreach([
                        ['label' => 'Operations', 'value' => 26, 'color' => 'bg-primary'],
                        ['label' => 'Pending', 'value' => 14, 'color' => 'bg-dark'],
                        ['label' => 'Delivery', 'value' => 9, 'color' => 'bg-primary/40'],
                    ] as $item)
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-[11px]">
                            <span class="font-bold text-dark/40 uppercase tracking-widest">{{ $item['label'] }}</span>
                            <span class="font-black text-dark italic">{{ $item['value'] }}</span>
                        </div>
                        <div class="w-full h-2 bg-dark/5 rounded-full overflow-hidden">
                            <div class="h-full {{ $item['color'] }} rounded-full" style="width: {{ ($item['value']/30)*100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="w-full py-4 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10 hover:scale-[1.02] transition-all">
                    System Maintenance
                </button>
            </div>

            <!-- Messages / Feed -->
            <div class="space-y-6">
                <div class="flex justify-between items-center px-4">
                    <h6 class="text-[13px] font-black text-dark uppercase tracking-widest">Latest Activity</h6>
                    <span class="text-[9px] font-black text-primary uppercase tracking-[0.2em] italic">Live</span>
                </div>
                
                @foreach([
                    ['name' => 'Evelyn D.', 'msg' => 'Donated $500', 'time' => '22m'],
                    ['name' => 'Jane C.', 'msg' => 'New partner reg', 'time' => '18m'],
                    ['name' => 'Theresa W.', 'msg' => 'Meal delivered', 'time' => '1h'],
                ] as $feed)
                <div class="bg-white rounded-xl p-5 flex items-center space-x-5 shadow-sm hover:shadow-md transition-all border border-black/5 group cursor-pointer">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center group-hover:bg-primary transition-colors duration-500">
                        <span class="text-primary group-hover:text-white font-black text-sm">{{ substr($feed['name'], 0, 1) }}</span>
                    </div>
                    <div class="flex-1 space-y-0.5">
                        <p class="text-[11px] font-black text-dark">{{ $feed['name'] }}</p>
                        <p class="text-[10px] font-medium text-dark/40 truncate leading-tight">{{ $feed['msg'] }}</p>
                    </div>
                    <span class="text-[8px] font-bold text-dark/20 uppercase tracking-tighter">{{ $feed['time'] }}</span>
                </div>
                @endforeach
            </div>
        </aside>
    </div>
    
    <!-- Logout FAB -->
    <div class="fixed bottom-8 right-8 z-[100]">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-14 h-14 bg-dark text-white rounded-xl shadow-2xl hover:scale-110 transition-all flex items-center justify-center group">
                <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            </button>
        </form>
    </div>
</main>
@endsection

@section('js_custom')
    @vite(['resources/js/docs-animations.js'])
@endsection

@section('js_custom')
    @vite(['resources/js/docs-animations.js'])
@endsection
