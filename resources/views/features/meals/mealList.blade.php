@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
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
                <!-- Navigation links would go here, omitting for brevity in shared view -->
                <p class="text-white/60 text-sm">Please use desktop for full menu access in this view.</p>
                 <button @click="mobileMenuOpen = false" class="mt-4 text-white font-bold">Close</button>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="lg:pl-[320px]">
        <div class="max-w-[1800px] mx-auto p-4 md:p-8 lg:p-12 space-y-12">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-h2 text-dark tracking-tighter">Meal Management</h1>
                    <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Manage Inventory & Availability</p>
                </div>
                @if(auth()->user()->role === 'partner')
                <a href="{{ route('meal.create') }}" class="px-8 py-3 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10 hover:scale-105 transition-all flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                    Add New Meal
                </a>
                @endif
            </div>

            <!-- Meals Table -->
            <div class="bg-white rounded-xl p-8 md:p-10 border border-black/5 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                                <th class="pb-6 pl-2">Meal Info</th>
                                <th class="pb-6">Ingredients</th>
                                <th class="pb-6">Status</th>
                                <th class="pb-6 text-right pr-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @forelse ($meals as $meal)
                            <tr class="group hover:bg-dark/5 transition-all">
                                <td class="py-8 pl-2">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 rounded-xl bg-dark/5 flex items-center justify-center overflow-hidden border border-black/5">
                                            @if($meal->mealImage)
                                                <img src="{{ asset('storage/'.$meal->mealImage) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-dark/10 text-xl font-black">{{ substr($meal->mealName, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-dark">{{ $meal->mealName }}</p>
                                            <span class="px-2 py-1 bg-primary/10 text-primary text-[9px] font-black uppercase rounded tracking-widest mt-1 inline-block">
                                                {{ $meal->mealType }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-8">
                                    <p class="text-[11px] font-bold text-dark/60 leading-relaxed max-w-[200px] line-clamp-2">
                                        {{ $meal->mealIngredient }}
                                    </p>
                                </td>
                                <td class="py-8">
                                    @php
                                        $isAvailable = $meal->mealAvailability === 'available';
                                        $statusColor = $isAvailable ? 'bg-green-500/10 text-green-600' : 'bg-red-500/10 text-red-600';
                                    @endphp
                                    <span class="px-4 py-1.5 {{ $statusColor }} rounded-full text-[9px] font-black uppercase tracking-widest">
                                        {{ $meal->mealAvailability }}
                                    </span>
                                </td>
                                <td class="py-8 text-right pr-2">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('meal.edit', $meal->id) }}" class="p-2 bg-white border border-black/5 rounded-lg text-dark/40 hover:text-dark hover:border-black/20 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </a>
                                        <form action="{{ route('meal.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Please confirm you want to delete this meal.')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-500/5 border border-red-500/10 rounded-lg text-red-500/60 hover:text-red-500 hover:bg-red-500/10 transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-dark/5 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-dark/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                        </div>
                                        <h3 class="text-dark font-black text-lg tracking-tight">No Meals Found</h3>
                                        <p class="text-dark/40 text-xs font-bold uppercase tracking-widest mt-1">Start by adding your first meal</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
