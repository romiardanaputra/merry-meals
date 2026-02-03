{{--
    Superadmin Dashboard
    Full platform management using reusable layout
--}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Platform Overview Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-[#222222] tracking-tighter">Platform Control</h1>
            <p class="text-[#222222]/40 text-sm font-medium mt-1">System-wide monitoring and management</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="px-4 py-2 bg-red-500/10 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest border border-red-500/20">
                Superadmin Access
            </span>
            <a href="{{ route('superadmin.settings') }}" class="px-4 py-2 bg-[#222222] text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#FF7B54] hover:text-[#222222] transition-all">
                Settings
            </a>
        </div>
    </div>

    {{-- Main Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <x-dashboard.stat-card 
            label="Total Users" 
            :value="$stats['total_users']" 
            color="dark"
            subtitle="All registered accounts"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card 
            label="Total Orders" 
            :value="$stats['total_orders']" 
            color="primary"
            subtitle="All time orders"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-[#222222]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card 
            label="Active Deliveries" 
            :value="$stats['active_deliveries']" 
            color="warning"
            subtitle="In progress now"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-[#222222]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>

        <x-dashboard.stat-card 
            label="Delivered" 
            :value="$stats['delivered_orders']" 
            color="success"
            subtitle="Successfully completed"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </x-slot:icon>
        </x-dashboard.stat-card>
    </div>

    {{-- Role Distribution --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <div class="bg-white rounded-xl p-6 border border-black/5 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#222222]/30">Members</span>
                    <h3 class="text-2xl font-black text-[#222222] tracking-tighter mt-1">{{ $stats['total_members'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-black/5 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#222222]/30">Drivers</span>
                    <h3 class="text-2xl font-black text-[#222222] tracking-tighter mt-1">{{ $stats['total_drivers'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-green-500/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 0V3a2 2 0 012-2h2a2 2 0 012 2v4m-6 0h6"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-black/5 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#222222]/30">Partners</span>
                    <h3 class="text-2xl font-black text-[#222222] tracking-tighter mt-1">{{ $stats['total_partners'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-purple-500/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-black/5 shadow-sm hover:shadow-lg transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#222222]/30">Admins</span>
                    <h3 class="text-2xl font-black text-[#222222] tracking-tighter mt-1">{{ $stats['total_admins'] }}</h3>
                </div>
                <div class="w-10 h-10 bg-red-500/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        {{-- Recent Orders Table --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-black/5 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-black/5 flex items-center justify-between">
                <h3 class="text-sm font-black text-[#222222] uppercase tracking-wider">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-black text-[#FF7B54] uppercase tracking-wider hover:underline">
                    View All →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[9px] font-black text-[#222222]/30 uppercase tracking-[0.2em] border-b border-black/5">
                            <th class="px-6 py-4">Order</th>
                            <th class="px-6 py-4">Member</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-black/5 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-xs font-black text-[#222222]">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-medium text-[#222222]/60">{{ $order->user->name ?? 'Unknown' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-{{ $order->statusColor }}-500/10 text-{{ $order->statusColor }}-600 rounded-full text-[9px] font-black uppercase tracking-wider">
                                        {{ $order->statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-medium text-[#222222]/40">{{ $order->created_at->format('d M, H:i') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-[#222222]/30 text-sm">
                                    No orders found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quick Actions Panel --}}
        <div class="space-y-6">
            {{-- Recent Users --}}
            <div class="bg-white rounded-xl border border-black/5 shadow-sm p-6">
                <h3 class="text-sm font-black text-[#222222] uppercase tracking-wider mb-4">Recent Users</h3>
                <div class="space-y-3">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center space-x-3 p-3 bg-black/5 rounded-xl">
                            <div class="w-10 h-10 bg-[#FF7B54] rounded-xl flex items-center justify-center">
                                <span class="text-[#222222] font-black text-sm uppercase">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-black text-[#222222] truncate">{{ $user->name }}</p>
                                <p class="text-[10px] font-bold text-[#222222]/40 uppercase tracking-wider">{{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#222222]/30 text-center py-4">No recent users</p>
                    @endforelse
                </div>
            </div>

            {{-- System Health --}}
            <div class="bg-[#222222] rounded-xl p-6 text-white">
                <h3 class="text-sm font-black uppercase tracking-wider mb-4">System Health</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium text-white/60">Server Status</span>
                        <span class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="text-xs font-black text-green-400">Online</span>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium text-white/60">Database</span>
                        <span class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="text-xs font-black text-green-400">Connected</span>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium text-white/60">Pending Orders</span>
                        <span class="text-xs font-black text-[#FF7B54]">{{ $stats['pending_orders'] }}</span>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="bg-white rounded-xl border border-black/5 shadow-sm p-6">
                <h3 class="text-sm font-black text-[#222222] uppercase tracking-wider mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-3 bg-black/5 hover:bg-[#222222] hover:text-white rounded-xl transition-all group">
                        <svg class="w-5 h-5 text-[#222222]/40 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="text-xs font-black uppercase tracking-wider">Manage Users</span>
                    </a>
                    <a href="{{ route('admin.partners.index') }}" class="flex items-center space-x-3 p-3 bg-black/5 hover:bg-[#222222] hover:text-white rounded-xl transition-all group">
                        <svg class="w-5 h-5 text-[#222222]/40 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="text-xs font-black uppercase tracking-wider">Manage Partners</span>
                    </a>
                    <a href="{{ route('donator.list') }}" class="flex items-center space-x-3 p-3 bg-black/5 hover:bg-[#222222] hover:text-white rounded-xl transition-all group">
                        <svg class="w-5 h-5 text-[#222222]/40 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-xs font-black uppercase tracking-wider">View Donations</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
