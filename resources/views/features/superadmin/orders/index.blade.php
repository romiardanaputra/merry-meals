{{-- Superadmin Orders Index View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#222222] tracking-tight">Order Management</h1>
            <p class="text-sm text-gray-500 mt-1">Monitor and manage all platform orders</p>
        </div>
        <div class="flex items-center space-x-3">
            <form action="{{ route('superadmin.orders.index') }}" method="GET" class="flex items-center space-x-2">
                <select name="status" onchange="this.form.submit()" 
                        class="px-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent">
                    <option value="all">All Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Orders Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Partner</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Driver</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-[#222222]">#{{ $order->id }}</span>
                                <p class="text-xs text-gray-400">{{ $order->meal->name ?? 'Unknown Meal' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-700">{{ $order->user->name ?? $order->user->username ?? 'Unknown' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $order->partner->restaurantName ?? 'Unknown' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->volunteer)
                                    <p class="text-sm text-gray-600">{{ $order->volunteer->name ?? $order->volunteer->username }}</p>
                                @else
                                    <span class="text-xs text-gray-400">Not assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $order->statusColor === 'green' ? 'bg-green-100 text-green-700' : ($order->statusColor === 'red' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ $order->statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    {{-- Assign Driver --}}
                                    @if(!$order->volunteerID && !$order->isFinalState())
                                        <form action="{{ route('superadmin.orders.assign', $order) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            <select name="driver_id" class="px-2 py-1 border border-gray-200 rounded-lg text-xs">
                                                <option value="">Assign</option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{ $driver->id }}">{{ $driver->name ?? $driver->username }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded-lg text-xs font-bold">Go</button>
                                        </form>
                                    @endif
                                    
                                    {{-- Cancel --}}
                                    @if(!$order->isFinalState())
                                        <form action="{{ route('superadmin.orders.cancel', $order) }}" method="POST" 
                                              onsubmit="return confirm('Cancel this order?')">
                                            @csrf
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <p class="font-medium">No orders found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $orders->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
