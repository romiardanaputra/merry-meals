@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-dark tracking-tighter">Meal Management</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Manage your restaurant's meal inventory and menus</p>
        </div>
        <a href="{{ route('partner.meals.create') }}" 
           class="inline-flex items-center px-8 py-4 bg-primary text-dark rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/20">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add New Meal
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl font-bold text-sm flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Meals Table --}}
    <div class="bg-white rounded-3xl border border-black/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-black/5">
                    <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em]">
                        <th class="px-8 py-6">Meal Details</th>
                        <th class="px-8 py-6">Type</th>
                        <th class="px-8 py-6">Ingredients</th>
                        <th class="px-8 py-6">Status</th>
                        <th class="px-8 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @forelse($meals as $meal)
                        <tr class="group hover:bg-gray-50/50 transition-all">
                            <td class="px-8 py-8">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-100 overflow-hidden shadow-sm">
                                        @php 
                                            $imageSource = $meal->mealImage 
                                                ? (Str::startsWith($meal->mealImage, 'http') ? $meal->mealImage : asset('storage/' . $meal->mealImage))
                                                : null;
                                        @endphp
                                        @if($imageSource)
                                            <img src="{{ $imageSource }}" alt="{{ $meal->mealName }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-dark/20 uppercase font-black text-xl">
                                                {{ substr($meal->mealName, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-dark">{{ $meal->mealName }}</p>
                                        <p class="text-[10px] font-bold text-dark/30 truncate max-w-[200px] mt-1">{{ Str::limit($meal->mealDescription, 60) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-8">
                                <span class="px-4 py-2 bg-primary/10 text-primary rounded-xl text-[10px] font-black uppercase tracking-widest">
                                    {{ $meal->mealType }}
                                </span>
                            </td>
                            <td class="px-8 py-8">
                                <p class="text-[11px] font-medium text-dark/60 leading-relaxed max-w-[220px]">{{ $meal->mealIngredient }}</p>
                            </td>
                            <td class="px-8 py-8">
                                <div class="flex items-center">
                                    @php $isAvailable = strtolower($meal->mealAvailability) === 'available'; @endphp
                                    <span class="w-2 h-2 rounded-full mr-3 {{ $isAvailable ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $isAvailable ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $meal->mealAvailability }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-8 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('partner.meals.edit', $meal->id) }}" 
                                       class="w-10 h-10 rounded-xl bg-dark/5 text-dark flex items-center justify-center hover:bg-dark hover:text-white transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('partner.meals.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Delete this meal permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-24 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-dark/5 rounded-full flex items-center justify-center mb-6 text-dark/10">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-dark font-black text-xl tracking-tight">Menu is Empty</h3>
                                    <p class="text-dark/40 text-[10px] font-bold uppercase tracking-widest mt-2">Start showcasing your culinary heritage</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($meals) && method_exists($meals, 'hasPages') && $meals->hasPages())
            <div class="px-8 py-6 border-t border-black/5 bg-gray-50/30">
                {{ $meals->links('partials.custom-pagination') }}
            </div>
        @endif
    </div>
</div>
@endsection
