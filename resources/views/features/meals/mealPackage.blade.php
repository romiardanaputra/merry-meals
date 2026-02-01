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
    <div class="max-w-[1400px] mx-auto">
        <!-- Progress Steps -->
        <div class="flex items-center justify-center mb-16 space-x-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-dark/5 text-dark/40 rounded-full flex items-center justify-center text-[10px] font-black">01</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-dark/20">Menu</span>
            </div>
            <div class="w-12 h-px bg-black/5"></div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-dark/5 text-dark/40 rounded-full flex items-center justify-center text-[10px] font-black">02</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-dark/20">Details</span>
            </div>
            <div class="w-12 h-px bg-black/5"></div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-primary text-dark rounded-full flex items-center justify-center text-[10px] font-black shadow-lg shadow-primary/20">03</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-dark">Packaging</span>
            </div>
        </div>

        <div class="text-center mb-16">
            <h1 class="text-h2 text-dark tracking-tighter">Select Your Packaging</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2 italic">How should we prepare your meal for delivery?</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16">
            <!-- Basic Package -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-16 border border-black/5 shadow-sm hover:shadow-2xl transition-all duration-700 group flex flex-col items-center text-center space-y-10 relative overflow-hidden">
                <div class="w-48 h-48 bg-dark/5 rounded-[2.5rem] flex items-center justify-center p-8 group-hover:scale-110 transition-transform duration-700">
                    <img src="/images/FoodPackageBasic.png" class="w-full h-full object-contain" alt="Basic Package">
                </div>

                <div class="space-y-6 flex-1">
                    <div class="space-y-2">
                        <h3 class="text-3xl font-black text-dark tracking-tighter">Basic</h3>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-dark/20 italic">Standard Protection</span>
                    </div>

                    <ul class="space-y-4 inline-block text-left">
                        <li class="flex items-center space-x-3 text-sm font-medium text-dark/60">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span>Wrapped in secure plastic wrap</span>
                        </li>
                        <li class="flex items-center space-x-3 text-sm font-medium text-dark/60">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span>Delivered in a breathable paper bag</span>
                        </li>
                    </ul>
                </div>

                <form action="{{ route('member.store', ['meal' => $meal->id, 'package' => 'basic', 'partnerID' => $meal->partnerID]) }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-6 bg-dark/5 hover:bg-dark text-dark hover:text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] transition-all transform hover:scale-[1.02] active:scale-95">
                        ORDER BASIC PACK
                    </button>
                </form>
            </div>

            <!-- Exclusive Package -->
            <div class="bg-dark rounded-[3rem] p-10 lg:p-16 border border-white/5 shadow-2xl shadow-dark/20 group flex flex-col items-center text-center space-y-10 relative overflow-hidden">
                <!-- Premium Glow -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-all duration-1000"></div>

                <div class="w-48 h-48 bg-white/5 rounded-[2.5rem] flex items-center justify-center p-8 group-hover:scale-110 transition-transform duration-700 relative z-10">
                    <img src="/images/FoodPackageExclusive.png" class="w-full h-full object-contain" alt="Exclusive Package">
                </div>

                <div class="space-y-6 flex-1 relative z-10">
                    <div class="space-y-2">
                        <h3 class="text-3xl font-black text-white tracking-tighter">Exclusive</h3>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary italic">Maximum Preservation</span>
                    </div>

                    <ul class="space-y-4 inline-block text-left">
                        <li class="flex items-center space-x-3 text-sm font-medium text-white/60">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span>Full aluminum foil thermal wrapping</span>
                        </li>
                        <li class="flex items-center space-x-3 text-sm font-medium text-white/60">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span>Secondary protective plastic seal</span>
                        </li>
                        <li class="flex items-center space-x-3 text-sm font-medium text-white/60">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span>Reinforced eco-friendly paper bag</span>
                        </li>
                    </ul>
                </div>

                <form action="{{ route('member.store', ['meal' => $meal->id, 'package' => 'exclusive', 'partnerID' => $meal->partnerID]) }}" method="POST" class="w-full relative z-10">
                    @csrf
                    <button type="submit" class="w-full py-6 bg-primary text-dark hover:bg-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-primary/20 transition-all transform hover:scale-[1.02] active:scale-95">
                        ORDER EXCLUSIVE PACK
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('meal.detail', $meal->id) }}" class="text-[10px] font-black uppercase tracking-widest text-dark/30 hover:text-dark transition-colors italic">
                ← Change meal selection
            </a>
        </div>
    </div>
</main>
@endsection