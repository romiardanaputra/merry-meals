@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="w-full mx-auto space-y-12">
    {{-- Header --}}
    <div class="mb-12">
        <h1 class="text-3xl font-black text-dark tracking-tighter">Restaurant Profile</h1>
        <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Manage your establishment details and public presence</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-3xl p-8 md:p-12 border border-black/5 shadow-sm">
        <form action="{{ route('partner.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-16">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Left Column: Primary Info & Operational Hours -->
                <div class="space-y-12">
                    <!-- Basic Information -->
                    <div class="space-y-8">
                        <div class="flex items-center space-x-4 border-b border-black/5 pb-4">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-dark tracking-tight">Basic Information</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="restaurantName" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Restaurant Name</label>
                                <input type="text" name="restaurantName" id="restaurantName" required value="{{ old('restaurantName') ?? $partner->restaurantName }}"
                                    class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-dark/20">
                                @error('restaurantName') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="ownerName" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Legal Owner Name</label>
                                <input type="text" name="ownerName" id="ownerName" required value="{{ old('ownerName') ?? $partner->ownerName }}"
                                    class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-dark/20">
                                @error('ownerName') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label for="foodType" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Cuisine / Food Category</label>
                                <div class="relative">
                                    <select name="foodType" id="foodType" required
                                        class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all appearance-none cursor-pointer capitalize">
                                        <option value="vegan friendly" {{ (old('foodType') ?? $partner->foodType) == 'vegan friendly' ? 'selected' : '' }}>Vegan Friendly</option>
                                        <option value="non vegan friendly" {{ (old('foodType') ?? $partner->foodType) == 'non vegan friendly' ? 'selected' : '' }}>Non Vegan Friendly</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-6 pointer-events-none text-dark/40">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                    </div>
                                </div>
                                @error('foodType') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Operational Hours -->
                    <div class="space-y-8">
                        <div class="flex items-center justify-between border-b border-black/5 pb-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-black text-dark tracking-tight">Operational Hours</h3>
                            </div>
                            @if($partner->isOpen())
                                <span class="px-4 py-1.5 bg-green-500/10 text-green-600 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                    <span class="block w-2 h-2 rounded-full bg-green-500"></span>
                                    Currently Open
                                </span>
                            @else
                                <span class="px-4 py-1.5 bg-red-500/10 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                    <span class="block w-2 h-2 rounded-full bg-red-500"></span>
                                    Currently Closed
                                </span>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="opening_time" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Opening Time</label>
                                <input type="time" name="opening_time" id="opening_time" required value="{{ old('opening_time') ?? \Carbon\Carbon::parse($partner->opening_time)->format('H:i') }}"
                                    class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                @error('opening_time') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="closing_time" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Closing Time</label>
                                <input type="time" name="closing_time" id="closing_time" required value="{{ old('closing_time') ?? \Carbon\Carbon::parse($partner->closing_time)->format('H:i') }}"
                                    class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                @error('closing_time') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <p class="text-[10px] text-dark/30 font-medium italic">Status will automatically toggle on your public menu and dashboard.</p>
                    </div>
                </div>

                <!-- Right Column: Contact & Media -->
                <div class="space-y-12">
                    <div class="space-y-8">
                        <div class="flex items-center space-x-4 border-b border-black/5 pb-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-dark tracking-tight">Contact & Media</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="restaurantContact" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Business Contact Number</label>
                                <input type="text" name="restaurantContact" id="restaurantContact" required value="{{ old('restaurantContact') ?? $partner->restaurantContact }}"
                                    class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-dark/20">
                                @error('restaurantContact') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="restaurantAddress" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Physical Location Address</label>
                                <input type="text" name="restaurantAddress" id="restaurantAddress" required value="{{ old('restaurantAddress') ?? $partner->restaurantAddress }}"
                                    class="w-full bg-[#fcfcfc] border border-black/5 rounded-2xl px-6 py-4 text-sm font-bold text-dark focus:ring-2 focus:ring-primary focus:border-transparent transition-all placeholder:text-dark/20">
                                @error('restaurantAddress') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-4 pt-4">
                                <label for="restaurantImage" class="text-[10px] font-black uppercase tracking-widest text-dark/40">Restaurant Visual Identity</label>
                                <div class="flex flex-col items-start gap-6">
                                    @if($partner->restaurantImage)
                                    <div class="w-full h-48 rounded-3xl overflow-hidden border border-black/5 shadow-inner bg-gray-50">
                                        <img src="{{ Str::startsWith($partner->restaurantImage, 'http') ? $partner->restaurantImage : asset('storage/' . $partner->restaurantImage) }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    @endif
                                    <div class="w-full">
                                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-black/10 rounded-3xl cursor-pointer hover:bg-gray-50 transition-colors">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-dark/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                                <p class="mb-2 text-[10px] text-dark font-black uppercase tracking-widest">Choose new identity</p>
                                                <p class="text-[9px] text-dark/30 font-bold uppercase tracking-widest">JPG, PNG (MAX. 1MB)</p>
                                            </div>
                                            <input type="file" name="restaurantImage" id="restaurantImage" class="hidden">
                                        </label>
                                    </div>
                                </div>
                                @error('restaurantImage') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-12 border-t border-black/5 flex flex-col sm:flex-row justify-end gap-6">
                 <a href="{{ route('partner.index') }}" class="px-12 py-5 bg-white border border-black/10 text-dark rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-dark hover:text-white transition-all text-center">
                    Cancel Changes
                </a>
                <button type="submit" class="px-12 py-5 bg-primary text-dark rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20">
                    Update Restaurant Profile
                </button>
            </div>
        </form>
    </div>
        </form>
    </div>
</div>
@endsection
