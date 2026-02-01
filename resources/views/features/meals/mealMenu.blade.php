@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter p-4 sm:p-8 lg:p-12 overflow-x-hidden">
    <!-- Mobile-First Header (Same as Dashboard for consistency) -->
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
             class="fixed inset-0 bg-dark/20 backdrop-blur-sm z-[140] lg:hidden"
             @click="mobileMenuOpen = false"></div>

        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm p-2">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-xl font-black tracking-tight text-dark uppercase leading-none">Merry Meals</h1>
                <p class="text-[9px] font-bold text-primary tracking-widest uppercase mt-1">Nourishing Lives</p>
            </div>
        </div>

        <!-- Pill Navigation -->
        <nav x-data="{ 
                activeIndex: 1,
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

        <div class="hidden sm:flex items-center space-x-3">
             <a href="{{ route('member.dashboard') }}" class="px-6 py-3 bg-white border border-black/5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-dark hover:text-white transition-all">Back to Dashboard</a>
        </div>
    </header>

    <div class="max-w-[1800px] mx-auto">
        <div class="mb-16">
            <h1 class="text-h2 text-dark tracking-tighter">Choose Your Meal</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2 italic">Nutritious packages prepared with care</p>
        </div>

        <!-- Menu Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($meals as $meal)
            <div class="bg-white rounded-[2.5rem] overflow-hidden border border-black/5 shadow-sm hover:shadow-2xl transition-all duration-700 group flex flex-col h-full">
                <!-- Image Section -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('storage/' . $meal->mealImage) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" 
                         alt="{{ $meal->mealName }}">
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-black uppercase tracking-widest text-dark shadow-xl">
                            Premium Meal
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-10 flex flex-col flex-1 space-y-6">
                    <div class="space-y-2">
                        <h3 class="text-2xl font-black text-dark tracking-tighter leading-tight group-hover:text-primary transition-colors">
                            {{ $meal->mealName }}
                        </h3>
                        <p class="text-[10px] font-bold text-dark/30 uppercase tracking-[0.2em] italic truncate">
                            {{ $meal->mealIngredient }}
                        </p>
                    </div>

                    <p class="text-sm text-dark/60 font-medium leading-relaxed line-clamp-3">
                        {{ $meal->mealDescription }}
                    </p>

                    <div class="pt-6 border-t border-black/5 mt-auto flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-1.5 h-1.5 rounded-full {{ $meal->mealAvailability == 'available' ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $meal->mealAvailability == 'available' ? 'text-green-600' : 'text-red-500' }}">
                                {{ $meal->mealAvailability }}
                            </span>
                        </div>
                        
                        @if($meal->mealAvailability == 'available')
                            <a href="{{ route('meal.detail', $meal->id) }}" 
                               class="px-8 py-4 bg-dark text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10 hover:bg-primary hover:text-dark hover:scale-105 transition-all">
                                Select Package
                            </a>
                        @else
                            <button disabled class="px-8 py-4 bg-dark/5 text-dark/20 rounded-2xl font-black text-[10px] uppercase tracking-widest cursor-not-allowed">
                                Unavailable
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
