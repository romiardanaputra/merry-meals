@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="max-w-[1400px] space-y-12">
    {{-- Back Button --}}
    <div>
        <a href="{{ route('member.meals.menu') }}" class="inline-flex items-center space-x-3 text-dark/40 hover:text-dark transition-colors group">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm border border-black/5 group-hover:bg-dark group-hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest">Back to Menu</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
        {{-- Left: Meal Image --}}
        <div class="lg:col-span-7 relative">
            <div class="aspect-[16/10] rounded-[3rem] overflow-hidden shadow-2xl shadow-dark/10 group bg-gray-100">
                @if($meal->mealImage)
                    <img src="{{ Str::startsWith($meal->mealImage, 'http') ? $meal->mealImage : asset('storage/'. $meal->mealImage) }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" 
                         alt="{{ $meal->mealName }}">
                @else
                    <div class="w-full h-full flex items-center justify-center text-dark/10">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>
            {{-- Floating Info Badge --}}
            <div class="absolute -bottom-10 -right-10 bg-white p-10 rounded-[2.5rem] shadow-2xl border border-black/5 hidden md:block max-w-xs">
                <span class="text-[9px] font-black uppercase tracking-[0.3em] text-primary">Chef's Recommendation</span>
                <p class="text-xs font-medium text-dark/60 mt-4 leading-relaxed italic">"Slow-cooked with heritage ingredients to ensure maximum nutritional density for our members."</p>
            </div>
        </div>

        {{-- Right: Meal Details --}}
        <div class="lg:col-span-5 space-y-10">
            <div class="space-y-4">
                <h1 class="text-4xl font-black text-dark tracking-tighter leading-tight">{{ $meal->mealName }}</h1>
                <div class="flex flex-wrap items-center gap-4">
                    <span class="px-5 py-2 bg-dark text-white rounded-xl text-[9px] font-black uppercase tracking-widest italic">{{ $meal->mealType }}</span>
                    <div class="flex items-center space-x-1">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        @endfor
                    </div>
                    <div class="flex items-center space-x-2">
                        @php $isAvailable = strtolower($meal->mealAvailability) === 'available'; @endphp
                        <div class="w-2 h-2 rounded-full {{ $isAvailable ? 'bg-green-500' : 'bg-red-500' }}"></div>
                        <span class="text-[10px] font-black uppercase tracking-widest {{ $isAvailable ? 'text-green-600' : 'text-red-500' }}">{{ $meal->mealAvailability }}</span>
                    </div>
                </div>
            </div>

            {{-- Nutritional Info --}}
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-6 border border-black/5 text-center shadow-sm">
                    <p class="text-2xl font-black text-dark">{{ $meal->calories ?? '~' }}</p>
                    <p class="text-[9px] font-bold text-dark/40 uppercase tracking-widest mt-1">Calories</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-black/5 text-center shadow-sm">
                    <p class="text-2xl font-black text-primary">{{ $meal->protein ?? '~' }}g</p>
                    <p class="text-[9px] font-bold text-dark/40 uppercase tracking-widest mt-1">Protein</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-black/5 text-center shadow-sm">
                    <p class="text-2xl font-black text-dark">{{ $meal->carbs ?? '~' }}g</p>
                    <p class="text-[9px] font-bold text-dark/40 uppercase tracking-widest mt-1">Carbs</p>
                </div>
            </div>

            <div class="space-y-8">
                <div class="space-y-3">
                    <h6 class="text-[11px] font-black uppercase tracking-widest text-dark/30">The Ingredients</h6>
                    <p class="text-sm text-dark/80 font-medium leading-relaxed">{{ $meal->mealIngredient }}</p>
                </div>

                <div class="space-y-3">
                    <h6 class="text-[11px] font-black uppercase tracking-widest text-dark/30">Description</h6>
                    <p class="text-sm text-dark/60 font-medium leading-relaxed italic">"{{ $meal->mealDescription }}"</p>
                </div>
            </div>

            @if($isAvailable)
            <div class="pt-10 border-t border-black/5 space-y-4">
                <a href="{{ route('member.meals.package', $meal->id) }}" class="block">
                    <button class="w-full py-6 bg-dark text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-dark/20 hover:bg-primary hover:text-dark transition-all transform hover:scale-[1.02] active:scale-95">
                        SELECT DELIVERY PACKAGE
                    </button>
                </a>
                <p class="text-center text-[10px] text-dark/40 font-bold uppercase tracking-widest">Choose your preferred delivery schedule</p>
            </div>
            @else
            <div class="pt-10 border-t border-black/5">
                <div class="bg-red-50 rounded-3xl p-8 text-center border border-red-100">
                    <p class="text-sm font-black text-red-500 uppercase tracking-widest">Currently Unavailable</p>
                    <p class="text-xs text-red-400 mt-2">Please check back later or explore other delicious options</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
