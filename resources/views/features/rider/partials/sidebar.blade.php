{{-- Dark Sidebar for Driver Dashboard --}}
<aside class="fixed inset-y-0 left-0 w-[320px] bg-[#222222] z-50 hidden lg:flex flex-col">
    {{-- Logo Section --}}
    <div class="p-8 border-b border-white/5">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-8 h-8 object-contain" alt="Logo">
            </div>
            <div>
                <h1 class="text-white font-black tracking-tight uppercase text-sm">Merry Meals</h1>
                <span class="text-[9px] font-bold text-primary tracking-[0.2em] uppercase">Driver Portal</span>
            </div>
        </div>
    </div>

    {{-- Driver Profile Section --}}
    <div class="p-8 border-b border-white/5">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                <span class="text-dark font-black text-xl uppercase">{{ substr(auth()->user()->name ?? 'D', 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white font-black text-sm truncate">{{ auth()->user()->name ?? 'Driver' }}</p>
                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">Volunteer Driver</p>
            </div>
        </div>
        
        {{-- Availability Status --}}
        <div class="mt-6" x-data="{ available: {{ $isAvailable ?? 'true' }} }">
            <button @click="available = !available" 
                    class="w-full flex items-center justify-between p-4 rounded-xl transition-all duration-300"
                    :class="available ? 'bg-green-500/10' : 'bg-white/5'">
                <span class="text-[10px] font-black uppercase tracking-widest"
                      :class="available ? 'text-green-500' : 'text-white/40'">
                    <span x-show="available">Available for Delivery</span>
                    <span x-show="!available">Currently Offline</span>
                </span>
                <div class="relative w-12 h-6 rounded-full transition-colors duration-300"
                     :class="available ? 'bg-green-500' : 'bg-white/20'">
                    <div class="absolute top-1 w-4 h-4 bg-white rounded-full shadow-lg transition-all duration-300"
                         :class="available ? 'left-7' : 'left-1'"></div>
                </div>
            </button>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 p-6 space-y-2 overflow-y-auto">
        @php
            $navItems = [
                ['route' => 'driver.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'driver.dashboard', 'label' => 'My Deliveries', 'icon' => 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
                ['route' => 'profile.edit', 'label' => 'My Profile', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
            ];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}" 
               class="flex items-center space-x-4 px-5 py-4 rounded-xl transition-all duration-300
               {{ Request::routeIs($item['route']) && $loop->first ? 'bg-primary text-dark' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                </svg>
                <span class="font-bold text-sm tracking-tight">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Logout Section --}}
    <div class="p-6 border-t border-white/5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center space-x-3 px-5 py-4 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[10px] font-black uppercase tracking-widest">Sign Out</span>
            </button>
        </form>
    </div>
</aside>
