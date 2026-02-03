{{--
    Mobile Drawer Component
    Slide-in mobile navigation with role-aware filtering
    Based on DASHBOARD_ARCHITECTURE.md specifications
--}}
@php
    use App\Helpers\RoleNavigation;
    $icons = config('dashboard.icons', []);
@endphp

<div 
    x-show="mobileMenuOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 w-[280px] bg-[#222222] z-50 lg:hidden flex flex-col shadow-2xl"
    style="display: none;"
    @click.away="mobileMenuOpen = false"
>
    {{-- Header --}}
    <div class="p-6 border-b border-white/5 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6" alt="Logo">
            </div>
            <div>
                <h1 class="text-white font-black tracking-tight uppercase text-xs">Merry Meals</h1>
                <span class="text-[8px] font-bold text-[#FF7B54] tracking-[0.15em] uppercase">{{ ucfirst($role) }}</span>
            </div>
        </div>
        <button @click="mobileMenuOpen = false" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- User Profile --}}
    <div class="p-6 border-b border-white/5">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-[#FF7B54] rounded-xl flex items-center justify-center">
                <span class="text-[#222222] font-black text-lg uppercase">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white font-black text-sm truncate">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">{{ ucfirst($role) }}</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        @foreach($navItems as $item)
            @php
                $routeName = $item['route'] ?? '';
                // Check route accessibility
                $isAccessible = Route::has($routeName) && RoleNavigation::isRouteAccessible($routeName);
                $isActive = request()->routeIs($routeName . '*');
                $iconPath = $icons[$item['icon']] ?? '';
            @endphp
            
            @if($isAccessible)
                <a 
                    href="{{ route($routeName) }}" 
                    @click="mobileMenuOpen = false"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300
                        {{ $isActive 
                            ? 'bg-[#FF7B54] text-[#222222]' 
                            : 'text-white/60 hover:bg-white/5 hover:text-white' }}"
                >
                    <svg class="w-5 h-5 {{ $isActive ? 'text-[#222222]' : 'text-white/40' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconPath !!}
                    </svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    {{-- Logout --}}
    <div class="p-4 border-t border-white/5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Sign Out</span>
            </button>
        </form>
    </div>
</div>
