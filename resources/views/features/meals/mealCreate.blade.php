@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter">
    <!-- Sidebar Logic -->
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
        @include('features.admin.partials.sidebar')
    @else
        @include('features.partner.partials.sidebar')
    @endif

    <!-- Mobile Header -->
    <header x-data="{ mobileMenuOpen: false }" class="lg:hidden bg-white border-b border-black/5 p-4 sticky top-0 z-40">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-xl flex items-center justify-center text-white">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                </div>
                <span class="font-black text-dark tracking-tight uppercase">Merry Meal</span>
            </div>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-dark/60 hover:text-dark">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
        </div>

        <!-- Mobile Drawer (Simplified) -->
        <div x-show="mobileMenuOpen" style="display: none;" class="fixed inset-0 z-50 flex">
            <div class="fixed inset-0 bg-dark/20 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-[#222222] p-6 text-white">
                <p class="text-white/60 text-sm">Please use desktop for full form access.</p>
                 <button @click="mobileMenuOpen = false" class="mt-4 text-white font-bold">Close</button>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="lg:pl-[320px]">
        <div class="max-w-[1200px] mx-auto p-4 md:p-8 lg:p-12">
            <!-- Header -->
            <div class="mb-12">
                <a href="{{ route('meal.index') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-dark/40 hover:text-dark mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Back to Inventory
                </a>
                <h1 class="text-h2 text-dark tracking-tighter">Add New Meal</h1>
                <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Create a new menu item</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl p-8 md:p-12 border border-black/5 shadow-xl shadow-dark/5">
                <form action="{{ route('meal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="mealName" class="text-xs font-black uppercase tracking-widest text-dark">Meal Name</label>
                                <input type="text" name="mealName" id="mealName" required value="{{ old('mealName') }}"
                                    class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                    placeholder="e.g. Grilled Salmon">
                                @error('mealName') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="mealType" class="text-xs font-black uppercase tracking-widest text-dark">Meal Type</label>
                                <input type="text" name="mealType" id="mealType" required value="{{ old('mealType') }}"
                                    class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                    placeholder="e.g. Non-Vegetarian">
                                @error('mealType') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="mealIngredient" class="text-xs font-black uppercase tracking-widest text-dark">Ingredients</label>
                                <textarea name="mealIngredient" id="mealIngredient" rows="4" required
                                    class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                    placeholder="List main ingredients...">{{ old('mealIngredient') }}</textarea>
                                @error('mealIngredient') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="mealAvailability" class="text-xs font-black uppercase tracking-widest text-dark">Availability</label>
                                <div class="relative">
                                    <select name="mealAvailability" id="mealAvailability" required
                                        class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors appearance-none cursor-pointer">
                                        <option value="available">Available</option>
                                        <option value="not available">Not Available</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-dark/40">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </div>
                                </div>
                                @error('mealAvailability') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="mealImage" class="text-xs font-black uppercase tracking-widest text-dark">Meal Image</label>
                                <div class="relative group">
                                    <input type="file" name="mealImage" id="mealImage" required
                                        class="w-full file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-dark file:text-white hover:file:bg-primary hover:file:text-dark transition-all
                                        bg-[#F8F8F8] border border-black/5 rounded-xl text-sm font-bold text-dark/60">
                                </div>
                                @error('mealImage') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                             <div class="space-y-2">
                                <label for="mealDescription" class="text-xs font-black uppercase tracking-widest text-dark">Description</label>
                                <textarea name="mealDescription" id="mealDescription" rows="4" required
                                    class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                    placeholder="Describe the meal...">{{ old('mealDescription') }}</textarea>
                                @error('mealDescription') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-black/5 flex justify-end">
                        <button type="submit" class="px-8 py-4 bg-primary text-dark rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/20">
                            Create Meal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection