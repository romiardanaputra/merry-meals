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
        <!-- Back Button -->
        <div class="mb-12">
            <a href="{{ route('meal.menu') }}" class="inline-flex items-center space-x-3 text-dark/40 hover:text-dark transition-colors group">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm border border-black/5 group-hover:bg-dark group-hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest">Back to Menu</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
            <!-- Left: Meal Image -->
            <div class="lg:col-span-7 relative">
                <div class="aspect-[16/9] rounded-[3rem] overflow-hidden shadow-2xl shadow-dark/10 group">
                    <img src="{{ asset('storage/'. $meal->mealImage) }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" 
                         alt="{{ $meal->mealName }}">
                </div>
                <!-- Floating Info Badge -->
                <div class="absolute -bottom-10 -right-10 bg-white p-10 rounded-[2.5rem] shadow-2xl border border-black/5 hidden md:block max-w-xs animate-on-scroll">
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-primary">Chef's Recommendation</span>
                    <p class="text-xs font-medium text-dark/60 mt-4 leading-relaxed italic">"Slow-cooked with heritage ingredients to ensure maximum nutritional density for our members."</p>
                </div>
            </div>

            <!-- Right: Meal Details -->
            <div class="lg:col-span-5 space-y-12">
                <div class="space-y-4">
                    <h1 class="text-h2 text-dark tracking-tighter">{{ $meal->mealName }}</h1>
                    <div class="flex items-center space-x-4">
                        <span class="px-4 py-1.5 bg-dark text-white rounded-full text-[9px] font-black uppercase tracking-widest italic">Nutrient Rich</span>
                        <div class="flex items-center space-x-1">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="space-y-2">
                        <h6 class="text-[11px] font-black uppercase tracking-widest text-dark/30">The Ingredients</h6>
                        <p class="text-p text-dark/80 font-medium leading-relaxed">{{ $meal->mealIngredient }}</p>
                    </div>

                    <div class="space-y-2">
                        <h6 class="text-[11px] font-black uppercase tracking-widest text-dark/30">Description</h6>
                        <p class="text-p text-dark/60 font-medium leading-relaxed">{{ $meal->mealDescription }}</p>
                    </div>
                </div>

                <div class="pt-12 border-t border-black/5 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('meal.package', $meal->id) }}" class="flex-1">
                        <button class="w-full py-6 bg-dark text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-dark/20 hover:bg-primary hover:text-dark transition-all transform hover:scale-[1.02] active:scale-95">
                            SELECT THIS PACKAGE
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection