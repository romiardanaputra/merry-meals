{{--
    Dashboard Sidebar Component
    Dark themed sidebar with role-based navigation
    Based on DASHBOARD_ARCHITECTURE.md specifications
--}}
@php
    use App\Helpers\RoleNavigation;
    $icons = config('dashboard.icons', []);
@endphp

<aside class="fixed inset-y-0 left-0 w-[320px] bg-[#222222] z-50 hidden lg:flex flex-col">
    {{-- Logo Section --}}
    <div class="p-8 border-b border-white/5">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-8 h-8" alt="Merry Meals Logo">
            </div>
            <div>
                <h1 class="text-white font-black tracking-tight uppercase text-sm">Merry Meals</h1>
                <span class="text-[9px] font-bold text-[#FF7B54] tracking-[0.2em] uppercase">{{ ucfirst($role) }} Portal</span>
            </div>
        </div>
    </div>

    {{-- User Profile Section --}}
    <div class="p-8 border-b border-white/5">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 bg-[#FF7B54] rounded-xl flex items-center justify-center shadow-lg">
                <span class="text-[#222222] font-black text-xl uppercase">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white font-black text-sm truncate">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">{{ ucfirst($role) }}</p>
            </div>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 p-6 space-y-2 overflow-y-auto">
        @foreach($navItems as $item)
            @php
                $routeName = $item['route'] ?? '';
                // Double-check route accessibility (items should already be filtered but this is a safety check)
                $isAccessible = Route::has($routeName) && RoleNavigation::isRouteAccessible($routeName);
                $isActive = request()->routeIs($routeName . '*');
                $iconPath = $icons[$item['icon']] ?? '';
            @endphp
            
            @if($isAccessible)
                <a 
                    href="{{ route($routeName) }}" 
                    class="flex items-center space-x-4 px-5 py-4 rounded-xl transition-all duration-300 group
                        {{ $isActive 
                            ? 'bg-[#FF7B54] text-[#222222] shadow-lg shadow-[#FF7B54]/20' 
                            : 'text-white/60 hover:bg-white/5 hover:text-white' }}"
                >
                    <svg class="w-5 h-5 {{ $isActive ? 'text-[#222222]' : 'text-white/40 group-hover:text-white' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconPath !!}
                    </svg>
                    <span class="text-[11px] font-black uppercase tracking-widest">{{ $item['label'] }}</span>
                    @if(isset($item['badge']))
                        <span class="ml-auto bg-red-500 text-white text-[9px] font-bold px-2 py-1 rounded-full">
                            {{ $item['badge'] }}
                        </span>
                    @endif
                </a>
            @endif
        @endforeach
    </nav>

    {{-- Logout Button --}}
    <div class="p-6 border-t border-white/5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-3 px-5 py-4 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Sign Out</span>
            </button>
        </form>
    </div>
</aside>
