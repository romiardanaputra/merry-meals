{{-- Superadmin Reports Index View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-black text-[#222222] tracking-tight">Reports & Analytics</h1>
        <p class="text-sm text-gray-500 mt-1">Platform-wide statistics and insights</p>
    </div>

    {{-- Users by Role --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        @php
            $roleIcons = [
                'superadmin' => ['color' => 'purple', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                'admin' => ['color' => 'blue', 'icon' => 'M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                'member' => ['color' => 'gray', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                'partner' => ['color' => 'amber', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                'driver' => ['color' => 'green', 'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
            ];
            $colorClasses = [
                'purple' => 'bg-purple-50 text-purple-600',
                'blue' => 'bg-blue-50 text-blue-600',
                'gray' => 'bg-gray-50 text-gray-600',
                'amber' => 'bg-amber-50 text-amber-600',
                'green' => 'bg-green-50 text-green-600',
            ];
        @endphp
        @foreach($usersByRole as $role => $count)
            @php
                $roleInfo = $roleIcons[$role] ?? ['color' => 'gray', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'];
            @endphp
            <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 rounded-lg {{ $colorClasses[$roleInfo['color']] }} flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $roleInfo['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-500 uppercase">{{ ucfirst($role) }}</span>
                </div>
                <p class="text-2xl font-black text-[#222222]">{{ number_format($count) }}</p>
            </div>
        @endforeach
    </div>

    {{-- Orders & Donations Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Order Stats --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider mb-6">Orders by Status</h3>
            <div class="space-y-4">
                @php
                    $statusColors = [
                        'pending' => 'bg-gray-400',
                        'preparation' => 'bg-amber-400',
                        'ready_for_pickup' => 'bg-blue-400',
                        'assigned' => 'bg-indigo-400',
                        'picked_up' => 'bg-purple-400',
                        'in_transit' => 'bg-orange-400',
                        'delivered' => 'bg-green-500',
                        'cancelled' => 'bg-red-400',
                    ];
                    $totalOrders = array_sum($ordersByStatus);
                @endphp
                @foreach($ordersByStatus as $status => $count)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-600">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                            <span class="font-bold text-gray-800">{{ $count }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full {{ $statusColors[$status] ?? 'bg-gray-400' }} rounded-full" style="width: {{ $totalOrders > 0 ? ($count / $totalOrders) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Donation Stats --}}
        <div class="bg-gradient-to-br from-[#FF7B54] to-[#FF7B54]/80 rounded-2xl p-6 text-white">
            <h3 class="text-sm font-bold uppercase tracking-wider opacity-80 mb-6">Donation Summary</h3>
            <div class="space-y-6">
                <div>
                    <p class="text-xs opacity-70 mb-1">Total Raised</p>
                    <p class="text-3xl font-black">${{ number_format($donationStats['total']) }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs opacity-70 mb-1">Total Donors</p>
                        <p class="text-xl font-bold">{{ number_format($donationStats['count']) }}</p>
                    </div>
                    <div>
                        <p class="text-xs opacity-70 mb-1">Avg. Donation</p>
                        <p class="text-xl font-bold">${{ number_format($donationStats['average'], 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Partner Stats --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider mb-6">Partner Overview</h3>
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center">
                    <p class="text-3xl font-black text-[#222222]">{{ $partnerStats['total'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Total</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-green-600">{{ $partnerStats['approved'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Active</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black text-amber-600">{{ $partnerStats['pending'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Pending</p>
                </div>
            </div>
        </div>

        {{-- Top Partners --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider mb-6">Top Partners by Orders</h3>
            <div class="space-y-3">
                @forelse($topPartners as $index => $partner)
                    <div class="flex items-center space-x-3">
                        <span class="w-6 h-6 rounded-full bg-[#FF7B54]/10 text-[#FF7B54] text-xs font-bold flex items-center justify-center">{{ $index + 1 }}</span>
                        <span class="flex-1 text-sm font-medium text-gray-700 truncate">{{ $partner->restaurantName }}</span>
                        <span class="text-sm font-bold text-gray-500">{{ $partner->orders_count }} orders</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">No partner data available</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
