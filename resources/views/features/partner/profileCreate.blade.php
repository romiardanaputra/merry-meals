@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter">
    <!-- Navbar (Since no sidebar yet for new partners) -->
    <nav class="bg-[#222222] text-white p-6 sticky top-0 z-50">
        <div class="max-w-[1200px] mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                </div>
                <div>
                    <h1 class="font-black tracking-widest uppercase text-sm leading-none mb-0.5">Merry Meal</h1>
                    <p class="text-[9px] font-bold text-primary uppercase tracking-[0.2em]">Partner Onboarding</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-black uppercase tracking-widest text-white/60 hover:text-white transition-colors">
                    Sign Out
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-[1000px] mx-auto p-4 md:p-12 lg:py-20">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-h2 text-dark tracking-tighter">Complete Your Profile</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Setup your restaurant details to get started</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-black/5 shadow-xl shadow-dark/5">
            <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-black text-dark tracking-tight border-b border-black/5 pb-2">Basic Info</h3>
                        
                        <div class="space-y-2">
                            <label for="restaurantName" class="text-xs font-black uppercase tracking-widest text-dark">Restaurant Name</label>
                            <input type="text" name="restaurantName" id="restaurantName" required value="{{ old('restaurantName') }}"
                                class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                placeholder="Your Establishment Name">
                            @error('restaurantName') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="ownerName" class="text-xs font-black uppercase tracking-widest text-dark">Owner Name</label>
                            <input type="text" name="ownerName" id="ownerName" required value="{{ old('ownerName') }}"
                                class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                placeholder="Full Name">
                            @error('ownerName') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="foodType" class="text-xs font-black uppercase tracking-widest text-dark">Food Type</label>
                            <div class="relative">
                                <select name="foodType" id="foodType" required
                                    class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors appearance-none cursor-pointer capitalize">
                                    <option value="" disabled selected>Select Food Type</option>
                                    <option value="vegan friendly">Vegan Friendly</option>
                                    <option value="non vegan friendly">Non Vegan Friendly</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-dark/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                            @error('foodType') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-black text-dark tracking-tight border-b border-black/5 pb-2">Contact & Location</h3>

                        <div class="space-y-2">
                            <label for="restaurantContact" class="text-xs font-black uppercase tracking-widest text-dark">Contact Number</label>
                            <input type="text" name="restaurantContact" id="restaurantContact" required value="{{ old('restaurantContact') }}"
                                class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                placeholder="Phone Number">
                            @error('restaurantContact') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="restaurantAddress" class="text-xs font-black uppercase tracking-widest text-dark">Address</label>
                            <input type="text" name="restaurantAddress" id="restaurantAddress" required value="{{ old('restaurantAddress') }}"
                                class="w-full bg-[#F8F8F8] border border-black/5 rounded-xl px-4 py-3 text-sm font-bold text-dark focus:ring-0 focus:border-dark transition-colors placeholder:text-dark/20"
                                placeholder="Full Location Address">
                            @error('restaurantAddress') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2 pt-4">
                            <label for="restaurantImage" class="text-xs font-black uppercase tracking-widest text-dark">Restaurant Image</label>
                            <div class="relative group">
                                <input type="file" name="restaurantImage" id="restaurantImage" required
                                    class="w-full file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-dark file:text-white hover:file:bg-primary hover:file:text-dark transition-all
                                    bg-[#F8F8F8] border border-black/5 rounded-xl text-sm font-bold text-dark/60">
                            </div>
                            @error('restaurantImage') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-black/5 flex justify-end">
                    <button type="submit" class="w-full md:w-auto px-10 py-4 bg-primary text-dark rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-lg shadow-primary/20">
                        Create Profile & Start
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection