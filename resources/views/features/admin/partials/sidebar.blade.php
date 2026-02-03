<div class="sidebar w-full lg:w-[320px] min-h-screen bg-[#222222] flex flex-col justify-between items-center px-8 py-12 transition-all duration-300">
    <div class="flex flex-col w-full">
        <!-- Logo Section -->
        <a href="{{ route('index') }}" class="group">
            <div class="flex flex-col items-center mb-16 space-y-4">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-500">
                    <img src="/images/MerryMealLogo-02.png" alt="Merry Meal Logo" class="w-16 h-16 object-contain">
                </div>
                <div class="text-center">
                    <h1 class="text-white text-lg font-black tracking-[0.3em] leading-none mb-1">MERRY MEAL</h1>
                    <h2 class="text-primary text-[10px] font-bold tracking-[0.2em] uppercase">Meals on Wheels</h2>
                </div>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-3 w-full">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-6 py-4 rounded-xl transition-all duration-300 {{ Request::routeIs('admin.dashboard') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                <span class="text-sm tracking-tight">Manage Users</span>
            </a>
            
            <a href="{{ route('donator.list') }}" 
               class="flex items-center px-6 py-4 rounded-xl transition-all duration-300 {{ Request::routeIs('donator.list') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                <span class="text-sm tracking-tight">Donation History</span>
            </a>

            <!-- Placeholder for future modules -->
            <div class="pt-8 pb-2 px-6">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white/20">Operations</span>
            </div>

            <a href="{{ route('partner.meals.index') }}" 
               class="flex items-center px-6 py-4 rounded-xl transition-all duration-300 {{ Request::routeIs('partner.meals.index') ? 'bg-primary text-dark font-black shadow-lg shadow-primary/20' : 'text-white/60 hover:text-white hover:bg-white/5 font-bold' }}">
                <span class="text-sm tracking-tight">Meal Management</span>
            </a>
        </nav>
    </div>

    <!-- Logout Section -->
    <div class="w-full pt-8 border-t border-white/5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="flex items-center justify-center w-full px-6 py-4 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white font-black transition-all duration-500 group">
                <span class="text-sm tracking-tight mr-2">Sign Out</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>
</div>
