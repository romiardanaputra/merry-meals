{{-- Member Meal Menu View --}}
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
    {{-- Mobile-First Header --}}
    @include('features.member.partials.header')

    <div class="max-w-[1800px] mx-auto">
        <div class="mb-16">
            <h1 class="text-h2 text-dark tracking-tighter">Choose Your Meal</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2 italic">Nutritious packages prepared with care</p>
        </div>

        {{-- Menu Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($meals as $meal)
            <div class="bg-white rounded-[2.5rem] overflow-hidden border border-black/5 shadow-sm hover:shadow-2xl transition-all duration-700 group flex flex-col h-full">
                {{-- Image Section --}}
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

                {{-- Content Section --}}
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
                            <a href="{{ route('member.meals.detail', $meal->id) }}" 
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
