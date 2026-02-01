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
    <!-- Desktop Sidebar -->
    @include('features.partner.partials.sidebar')

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

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" 
             style="display: none;"
             class="fixed inset-0 z-50 flex">
            <div class="fixed inset-0 bg-dark/20 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-[#222222] p-6 pb-4">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                        </div>
                        <span class="text-white font-black tracking-widest uppercase text-xs">Partner</span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="text-white/40 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <nav class="space-y-2 flex-1">
                    <a href="{{ route('partner.index') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">Dashboard</a>
                    <a href="{{ route('meal.index') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">Meals</a>
                    <a href="{{ route('partner.orders.index') }}" class="block px-4 py-3 bg-primary text-dark rounded-xl font-bold text-sm tracking-tight">Orders</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-white/60 hover:text-white hover:bg-white/5 rounded-xl font-bold text-sm tracking-tight">Profile</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="lg:pl-[320px]">
        <div class="max-w-[1800px] mx-auto p-4 md:p-8 lg:p-12 space-y-12">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-h2 text-dark tracking-tighter">{{ $title_page }}</h1>
                    <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Manage incoming meal requests</p>
                </div>
            </div>
            
            @if(session('success'))
                <div class="p-4 bg-green-50 text-green-700 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Orders Table -->
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-black/5 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                                <th class="pb-6 pl-2">Order ID</th>
                                <th class="pb-6">Meal Details</th>
                                <th class="pb-6">Customer</th>
                                <th class="pb-6">Current Status</th>
                                <th class="pb-6">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/5">
                            @forelse($orders as $order)
                            <tr class="group hover:bg-dark/5 transition-all">
                                <td class="py-8 pl-2">
                                    <span class="text-xs font-black text-dark uppercase tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    <div class="mt-1 text-[9px] font-bold text-dark/40 uppercase tracking-widest">{{ $order->created_at->format('M d, H:i') }}</div>
                                </td>
                                <td class="py-8">
                                    <div class="flex items-center space-x-4">
                                        @if($order->meal->mealImage)
                                        <img src="{{ asset('storage/' . $order->meal->mealImage) }}" class="w-12 h-12 rounded-xl object-cover shadow-sm" alt="">
                                        @endif
                                        <div>
                                            <p class="text-sm font-black text-dark">{{ $order->meal->mealName }}</p>
                                            <p class="text-[10px] font-bold text-dark/30 uppercase tracking-widest mt-0.5">{{ $order->mealPackage }} • {{ $order->foodTemperature }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-8">
                                    <span class="text-xs font-bold text-dark">{{ $order->user->name }}</span>
                                    @if($order->user->address)
                                    <p class="text-[9px] font-medium text-dark/40 truncate max-w-[150px]">{{ $order->user->address }}</p>
                                    @endif
                                </td>
                                <td class="py-8">
                                     <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest 
                                        {{ $order->status === 'preparation' ? 'bg-yellow-500/10 text-yellow-600' : '' }}
                                        {{ $order->status === 'cooking' ? 'bg-orange-500/10 text-orange-600' : '' }}
                                        {{ $order->status === 'ready' ? 'bg-blue-500/10 text-blue-600' : '' }}
                                        {{ $order->status === 'picked_up' ? 'bg-purple-500/10 text-purple-600' : '' }}
                                        {{ $order->status === 'delivered' ? 'bg-green-500/10 text-green-600' : '' }}">
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                </td>
                                <td class="py-8">
                                    <form action="{{ route('partner.orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="bg-white border border-black/10 text-dark text-xs font-bold rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 uppercase tracking-wide cursor-pointer hover:border-dark/30 transition-colors">
                                            <option value="preparation" {{ $order->status == 'preparation' ? 'selected' : '' }}>Preparation</option>
                                            <option value="cooking" {{ $order->status == 'cooking' ? 'selected' : '' }}>Cooking</option>
                                            <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready for Pickup</option>
                                            <option value="picked_up" {{ $order->status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-dark/5 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-dark/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                                        </div>
                                        <h3 class="text-dark font-black text-lg tracking-tight">No Orders Yet</h3>
                                        <p class="text-dark/40 text-xs font-bold uppercase tracking-widest mt-1">Wait for incoming requests</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
