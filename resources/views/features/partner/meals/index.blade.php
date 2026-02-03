{{-- Partner Meal List View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#222222] tracking-tight">Meal Management</h1>
            <p class="text-sm text-gray-500 mt-1">Manage your restaurant's meal inventory</p>
        </div>
        <a href="{{ route('partner.meals.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-[#FF7B54] text-white rounded-xl font-bold text-sm hover:bg-[#FF7B54]/90 transition-all shadow-lg shadow-[#FF7B54]/20">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add New Meal
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Meals Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Meal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Ingredients</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($meals as $meal)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                        @if($meal->mealImage)
                                            <img src="{{ asset('storage/' . $meal->mealImage) }}" 
                                                 alt="{{ $meal->mealName }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-gray-400 font-bold text-lg">{{ substr($meal->mealName, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#222222]">{{ $meal->mealName }}</p>
                                        <p class="text-xs text-gray-400 line-clamp-1">{{ Str::limit($meal->mealDescription, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-[#FF7B54]/10 text-[#FF7B54] rounded-lg text-xs font-bold">
                                    {{ $meal->mealType }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 line-clamp-2 max-w-[200px]">{{ $meal->mealIngredient }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $isAvailable = $meal->mealAvailability === 'available';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($meal->mealAvailability) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('partner.meals.edit', $meal->id) }}" 
                                       class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('partner.meals.destroy', $meal->id) }}" method="POST" 
                                          onsubmit="return confirm('Delete this meal?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <p class="font-medium">No meals found</p>
                                <p class="text-sm mt-1">Start by adding your first meal</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($meals) && method_exists($meals, 'hasPages') && $meals->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $meals->links('partials.custom-pagination') }}
            </div>
        @endif
    </div>
@endsection
