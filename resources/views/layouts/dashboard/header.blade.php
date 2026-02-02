{{--
    Dashboard Header Component
    Mobile header with drawer toggle
    Based on DASHBOARD_ARCHITECTURE.md specifications
--}}
<header class="lg:hidden fixed top-0 left-0 right-0 bg-[#222222] z-40 px-4 py-4 shadow-lg">
    <div class="flex items-center justify-between">
        {{-- Menu Toggle --}}
        <button 
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all duration-300"
        >
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
            </svg>
        </button>

        {{-- Logo --}}
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6" alt="Logo">
            </div>
            <div>
                <h1 class="text-white font-black tracking-tight uppercase text-xs">Merry Meals</h1>
                <span class="text-[8px] font-bold text-[#FF7B54] tracking-[0.15em] uppercase">{{ ucfirst($role) }}</span>
            </div>
        </div>

        {{-- User Avatar --}}
        <div class="w-12 h-12 bg-[#FF7B54] rounded-xl flex items-center justify-center shadow-lg">
            <span class="text-[#222222] font-black text-lg uppercase">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
        </div>
    </div>
</header>

{{-- Spacer for fixed header --}}
<div class="lg:hidden h-20"></div>
