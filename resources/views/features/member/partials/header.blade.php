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
         class="fixed inset-y-0 left-0 w-[280px] bg-[#222222] shadow-2xl z-[150] lg:hidden flex flex-col justify-between py-8 px-6 border-r border-white/5"
         @click.away="mobileMenuOpen = false"
         style="display: none;">
        
        <div class="flex flex-col w-full">
            <!-- Logo Section -->
            <div class="flex flex-col items-center mb-10 space-y-4">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                </div>
                <div class="text-center">
                    <h1 class="text-white text-base font-black tracking-[0.3em] leading-none mb-1">MERRY MEAL</h1>
                    <h2 class="text-primary text-[8px] font-bold tracking-[0.2em] uppercase">Member Access</h2>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 space-y-2">
                <a href="{{ route('member.dashboard') }}" class="flex items-center px-6 py-3.5 rounded-xl transition-all duration-300 {{ Request::routeIs('member.dashboard') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                    <span class="text-xs tracking-tight uppercase">Overview</span>
                </a>
                <a href="{{ route('member.meals.menu') }}" class="flex items-center px-6 py-3.5 rounded-xl transition-all duration-300 {{ Request::routeIs('member.meals.menu') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                    <span class="text-xs tracking-tight uppercase">Browse Menu</span>
                </a>
                <a href="{{ route('member.survey') }}" class="flex items-center px-6 py-3.5 rounded-xl transition-all duration-300 {{ Request::routeIs('member.survey') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                    <span class="text-xs tracking-tight uppercase">Feedback</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3.5 rounded-xl transition-all duration-300 {{ Request::routeIs('profile.edit') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                    <span class="text-xs tracking-tight uppercase">My Profile</span>
                </a>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="w-full pt-6 border-t border-white/5">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-6 py-3.5 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white font-black transition-all duration-500 group">
                    <span class="text-xs tracking-tight uppercase mr-2">Sign Out</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Backdrop -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 bg-dark/20 backdrop-blur-sm z-[140] lg:hidden"
         @click="mobileMenuOpen = false"
         style="display: none;"></div>

    <!-- Logo & Mobile Actions -->
    <div class="flex items-center justify-between w-full lg:w-auto">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm p-2">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-xl font-black tracking-tight text-dark uppercase leading-none">Merry Meals</h1>
                <p class="text-[9px] font-bold text-primary tracking-widest uppercase mt-1">Nourishing Lives</p>
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
            activeIndex: {{ 
                ['member.dashboard' => 0, 'member.meals.menu' => 1, 'member.survey' => 2, 'profile.edit' => 3][Route::currentRouteName()] ?? 0 
            }},
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
                    ['route' => 'member.meals.menu', 'label' => 'Browse Menu', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
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
</header>
