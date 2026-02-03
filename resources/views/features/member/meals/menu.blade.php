@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="space-y-12">
    {{-- Header --}}
    <div>
        <h1 class="text-4xl font-black text-dark tracking-tighter">Choose Your Meal</h1>
        <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-3">Nutritious packages prepared with care by our heritage partners</p>
    </div>

    {{-- Menu Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
        @forelse($meals as $meal)
            <div class="bg-white rounded-[2.5rem] overflow-hidden border border-black/5 shadow-sm hover:shadow-2xl transition-all duration-700 group flex flex-col h-full">
                {{-- Image Section --}}
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ Str::startsWith($meal->mealImage, 'http') ? $meal->mealImage : asset('storage/' . $meal->mealImage) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" 
                         alt="{{ $meal->mealName }}">
                    <div class="absolute top-6 left-6">
                        <span class="px-5 py-2.5 bg-white/95 backdrop-blur-md rounded-2xl text-[10px] font-black uppercase tracking-widest text-dark shadow-xl">
                            Premium Meal
                        </span>
                    </div>
                    @if($meal->mealType)
                    <div class="absolute bottom-6 left-6">
                         <span class="px-4 py-2 bg-primary text-dark rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg">
                            {{ $meal->mealType }}
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Content Section --}}
                <div class="p-10 flex flex-col flex-1 space-y-6">
                    <div class="space-y-2">
                        <h3 class="text-2xl font-black text-dark tracking-tighter leading-tight group-hover:text-primary transition-colors">
                            {{ $meal->mealName }}
                        </h3>
                        <p class="text-[10px] font-bold text-dark/30 uppercase tracking-[0.2em] line-clamp-1">
                            {{ $meal->mealIngredient }}
                        </p>
                    </div>

                    <p class="text-sm text-dark/60 font-medium leading-relaxed line-clamp-3 italic">
                        "{{ Str::limit($meal->mealDescription, 120) }}"
                    </p>

                    <div class="pt-8 border-t border-black/5 mt-auto flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @php $isAvailable = strtolower($meal->mealAvailability) === 'available'; @endphp
                            <div class="w-2 h-2 rounded-full {{ $isAvailable ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $isAvailable ? 'text-green-600' : 'text-red-500' }}">
                                {{ $meal->mealAvailability }}
                            </span>
                        </div>
                        
                        @if($isAvailable)
                            <a href="{{ route('member.meals.detail', $meal->id) }}" 
                               class="px-8 py-4 bg-dark text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10 hover:bg-primary hover:text-dark hover:scale-105 active:scale-95 transition-all">
                                Select Package
                            </a>
                        @else
                            <button disabled class="px-8 py-4 bg-dark/5 text-dark/20 rounded-2xl font-black text-[10px] uppercase tracking-widest cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 text-center bg-white rounded-3xl border border-dashed border-black/10">
                <div class="w-20 h-20 bg-dark/5 rounded-full flex items-center justify-center mx-auto mb-6 text-dark/10">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="text-xl font-black text-dark tracking-tight">No Meals Available</h3>
                <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-2">Check back soon for our signature heritage dishes</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(isset($meals) && method_exists($meals, 'hasPages') && $meals->hasPages())
        <div class="mt-12">
            {{ $meals->links('partials.custom-pagination') }}
        </div>
    @endif
</div>
@endsection
