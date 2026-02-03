{{-- Partner Meal Edit View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('partner.meals.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#222222] transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Meals
        </a>
        <h1 class="text-2xl font-black text-[#222222] tracking-tight">Edit Meal</h1>
        <p class="text-sm text-gray-500 mt-1">Update {{ $meal->mealName }}</p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('partner.meals.update', $meal->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Meal Name --}}
                <div>
                    <label for="mealName" class="block text-sm font-bold text-gray-700 mb-2">Meal Name</label>
                    <input type="text" name="mealName" id="mealName" value="{{ old('mealName', $meal->mealName) }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">
                    @error('mealName')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Meal Type --}}
                <div>
                    <label for="mealType" class="block text-sm font-bold text-gray-700 mb-2">Meal Type</label>
                    <input type="text" name="mealType" id="mealType" value="{{ old('mealType', $meal->mealType) }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">
                    @error('mealType')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ingredients --}}
                <div class="md:col-span-2">
                    <label for="mealIngredient" class="block text-sm font-bold text-gray-700 mb-2">Ingredients</label>
                    <textarea name="mealIngredient" id="mealIngredient" rows="3" required
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">{{ old('mealIngredient', $meal->mealIngredient) }}</textarea>
                    @error('mealIngredient')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <label for="mealDescription" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea name="mealDescription" id="mealDescription" rows="4" required
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">{{ old('mealDescription', $meal->mealDescription) }}</textarea>
                    @error('mealDescription')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Availability --}}
                <div>
                    <label for="mealAvailability" class="block text-sm font-bold text-gray-700 mb-2">Availability</label>
                    <select name="mealAvailability" id="mealAvailability" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">
                        <option value="available" {{ old('mealAvailability', $meal->mealAvailability) === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="not available" {{ old('mealAvailability', $meal->mealAvailability) === 'not available' ? 'selected' : '' }}>Not Available</option>
                    </select>
                    @error('mealAvailability')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label for="mealImage" class="block text-sm font-bold text-gray-700 mb-2">
                        Meal Image <span class="font-normal text-gray-400">(leave empty to keep current)</span>
                    </label>
                    @if($meal->mealImage)
                        <div class="mb-3 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $meal->mealImage) }}" alt="{{ $meal->mealName }}" class="w-16 h-16 rounded-xl object-cover">
                            <span class="text-xs text-gray-400">Current image</span>
                        </div>
                    @endif
                    <input type="file" name="mealImage" id="mealImage" accept="image/*"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#FF7B54]/10 file:text-[#FF7B54]">
                    @error('mealImage')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                <a href="{{ route('partner.meals.index') }}" 
                   class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-[#FF7B54] text-white rounded-xl font-bold hover:bg-[#FF7B54]/90 transition-all shadow-lg shadow-[#FF7B54]/20">
                    Update Meal
                </button>
            </div>
        </form>
    </div>
@endsection
