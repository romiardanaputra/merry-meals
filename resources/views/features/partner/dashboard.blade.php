@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="space-y-12">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black text-dark tracking-tighter">{{ $partner->restaurantName }}</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2">Partner Dashboard • Overview</p>
        </div>
        <div class="flex items-center space-x-4">
            <span class="px-4 py-2 bg-green-500/10 text-green-600 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                <span class="block w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Kitchen Open
            </span>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        <x-dashboard.stat-card 
            label="Total Orders" 
            :value="$stats['total_orders']" 
            color="primary"
            icon="shopping-bag"
        />
        <x-dashboard.stat-card 
            label="Preparing" 
            :value="$stats['preparing']" 
            color="warning"
            icon="clock"
        />
        <x-dashboard.stat-card 
            label="Completed" 
            :value="$stats['completed']" 
            color="success"
            icon="check-circle"
        />
    </div>

    {{-- Chart & Trends --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-black/5 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-xl font-black text-dark tracking-tight">Order Weekly Trends</h3>
                    <p class="text-[10px] font-bold text-dark/30 uppercase tracking-widest mt-1">Volume of orders over the last 7 days</p>
                </div>
            </div>
            <div class="h-[300px] w-full relative">
                <canvas id="orderTrendChart"></canvas>
            </div>
        </div>

        <div class="bg-dark rounded-3xl p-8 text-white relative overflow-hidden group">
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-black tracking-tight">Daily Summary</h3>
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest mt-1">Today's snapshot</p>
                </div>
                
                <div class="space-y-6 my-8">
                    @php 
                        $todayCount = collect($trends)->last()['count'] ?? 0;
                        $yesterdayCount = collect($trends)->reverse()->values()->get(1)['count'] ?? 0;
                        $growth = $yesterdayCount > 0 ? round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100) : 100;
                    @endphp
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black">{{ $todayCount }}</span>
                        <span class="text-[10px] font-black uppercase {{ $growth >= 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $growth >= 0 ? '+' : '' }}{{ $growth }}% vs Yesterday
                        </span>
                    </div>
                    <p class="text-xs text-white/60 leading-relaxed font-medium">
                        Your kitchen activity is {{ $growth >= 0 ? 'higher' : 'lower' }} than yesterday. Keep up the great work!
                    </p>
                </div>

                <a href="{{ route('partner.orders.index') }}" class="w-full py-4 bg-white text-dark rounded-2xl font-black text-[10px] uppercase tracking-widest text-center hover:bg-primary transition-colors">
                    Manage Queue
                </a>
            </div>
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-primary/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-3xl p-8 md:p-10 border border-black/5 shadow-sm">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h4 class="text-2xl font-black text-dark tracking-tighter">Latest Orders</h4>
                <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Recent meal requests</p>
            </div>
            <a href="{{ route('partner.orders.index') }}" class="text-[10px] font-black uppercase tracking-widest text-primary hover:text-dark transition-colors">View All Orders</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-dark/20 uppercase tracking-[0.2em] border-b border-black/5">
                        <th class="pb-6 pl-2">ID</th>
                        <th class="pb-6">Meal</th>
                        <th class="pb-6">Customer</th>
                        <th class="pb-6">Status</th>
                        <th class="pb-6 pr-2 text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @forelse($orders as $order)
                    <tr class="group hover:bg-gray-50/50 transition-all">
                        <td class="py-6 pl-2">
                            <span class="text-xs font-black text-dark tracking-tighter">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="py-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-gray-100 overflow-hidden">
                                    <img src="{{ Str::startsWith($order->meal->mealImage, 'http') ? $order->meal->mealImage : asset('storage/' . $order->meal->mealImage) }}" 
                                         class="w-full h-full object-cover" alt="">
                                </div>
                                <span class="text-xs font-bold text-dark">{{ $order->meal->mealName }}</span>
                            </div>
                        </td>
                        <td class="py-6">
                            <span class="text-xs font-bold text-dark/60">{{ $order->user->name }}</span>
                        </td>
                        <td class="py-6">
                            <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest 
                                {{ $order->status === 'preparation' ? 'bg-yellow-500/10 text-yellow-600' : '' }}
                                {{ $order->status === 'cooking' ? 'bg-orange-500/10 text-orange-600' : '' }}
                                {{ $order->status === 'ready' ? 'bg-blue-500/10 text-blue-600' : '' }}
                                {{ $order->status === 'picked_up' ? 'bg-purple-500/10 text-purple-600' : '' }}
                                {{ $order->status === 'delivered' || $order->status === 'completed' ? 'bg-green-500/10 text-green-600' : '' }}">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                        </td>
                        <td class="py-6 pr-2 text-right">
                            <span class="text-[10px] font-bold text-dark/30">{{ $order->created_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <p class="text-dark/20 text-xs font-black uppercase tracking-[0.4em]">No active orders</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('orderTrendChart').getContext('2d');
        const trends = @json($trends);
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(255, 123, 84, 0.2)');
        gradient.addColorStop(1, 'rgba(255, 123, 84, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: trends.map(t => t.day),
                datasets: [{
                    label: 'Orders',
                    data: trends.map(t => t.count),
                    borderColor: '#FF7B54',
                    borderWidth: 4,
                    pointBackgroundColor: '#FF7B54',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: gradient
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#222',
                        titleFont: { family: 'Inter', weight: 'bold' },
                        bodyFont: { family: 'Inter' },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: { font: { family: 'Inter', weight: 'bold', size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', weight: 'bold', size: 10 } }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection