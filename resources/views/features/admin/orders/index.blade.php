@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/40 overflow-hidden">
    <div class="p-8 border-b border-border/40 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-dark tracking-tight">Order Oversight</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-widest mt-1">Monitor and Assign Deliveries</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark/[0.02]">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Order ID</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Member</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Partner</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Assign Rider</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/40">
                @forelse($orders as $order)
                <tr class="hover:bg-dark/[0.01] transition-colors group">
                    <td class="px-8 py-6">
                        <span class="text-xs font-black text-dark">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm font-bold text-dark">{{ $order->user->name }}</p>
                        <p class="text-[10px] font-medium text-dark/40">{{ $order->user->email }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm font-bold text-dark">{{ $order->partner->restaurantName }}</p>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusMap = [
                                'preparation' => 'bg-orange-500/10 text-orange-600',
                                'assigned' => 'bg-blue-500/10 text-blue-600',
                                'delivery' => 'bg-indigo-500/10 text-indigo-600',
                                'delivered' => 'bg-green-500/10 text-green-600',
                                'cancelled' => 'bg-red-500/10 text-red-600',
                            ];
                            $colorClass = $statusMap[$order->status] ?? 'bg-dark/5 text-dark/40';
                        @endphp
                        <span class="px-3 py-1.5 {{ $colorClass }} text-[10px] font-black uppercase rounded-lg tracking-widest">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @if($order->status === 'preparation')
                        <form action="{{ route('admin.orders.assign', $order->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <select name="volunteerID" class="text-[10px] font-bold uppercase tracking-widest bg-dark/5 border-none rounded-lg focus:ring-0 focus:bg-dark/10 transition-all p-2 pr-8">
                                <option value="" disabled selected>Select Rider</option>
                                @foreach($volunteers as $rider)
                                    <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="p-2 bg-dark text-white rounded-lg shadow-lg shadow-dark/10 hover:scale-110 active:scale-95 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 5l7 7-7 7M5 5l7 7-7 7" /></svg>
                            </button>
                        </form>
                        @elseif($order->volunteerID)
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-lg bg-primary/20 flex items-center justify-center">
                                <span class="text-primary font-black text-xs uppercase">{{ substr($order->volunteer->name, 0, 1) }}</span>
                            </div>
                            <span class="text-xs font-bold text-dark">{{ $order->volunteer->name }}</span>
                        </div>
                        @else
                        <span class="text-[10px] font-black text-dark/20 uppercase tracking-widest italic">Waiting...</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-dark/20 uppercase font-black text-sm tracking-widest">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
