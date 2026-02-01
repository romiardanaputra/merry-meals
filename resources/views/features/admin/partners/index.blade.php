@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/40 overflow-hidden">
    <div class="p-8 border-b border-border/40 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-dark tracking-tight">Partner Management</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-widest mt-1">Review and Manage Restaurant Partners</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark/[0.02]">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Restaurant</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Owner</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Food Type</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/40">
                @forelse($partners as $partner)
                <tr class="hover:bg-dark/[0.01] transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-xl bg-dark/5 flex items-center justify-center overflow-hidden border border-black/5">
                                @if($partner->restaurantImage)
                                    <img src="{{ asset('storage/'.$partner->restaurantImage) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-dark/20 text-xl font-black">{{ substr($partner->restaurantName, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-black text-dark leading-snug">{{ $partner->restaurantName }}</p>
                                <p class="text-[10px] font-bold text-dark/40 uppercase tracking-tighter">{{ $partner->restaurantAddress }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm font-bold text-dark">{{ $partner->ownerName }}</p>
                        <p class="text-[10px] font-medium text-dark/40">{{ $partner->restaurantContact }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-lg tracking-wider">
                            {{ $partner->foodType }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusColor = [
                                'pending' => 'bg-orange-500/10 text-orange-600',
                                'approved' => 'bg-green-500/10 text-green-600',
                                'rejected' => 'bg-red-500/10 text-red-600',
                            ][$partner->status] ?? 'bg-dark/5 text-dark/40';
                        @endphp
                        <span class="px-3 py-1.5 {{ $statusColor }} text-[10px] font-black uppercase rounded-lg tracking-widest">
                            {{ $partner->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-2">
                            @if($partner->status === 'pending')
                            <form action="{{ route('admin.partners.approve', $partner->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 bg-green-500 text-white rounded-lg shadow-lg shadow-green-500/20 hover:scale-110 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                </button>
                            </form>
                            <form action="{{ route('admin.partners.reject', $partner->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 bg-red-500 text-white rounded-lg shadow-lg shadow-red-500/20 hover:scale-110 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Silahkan konfirmasi penghapusan partner ini.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-dark/20 hover:text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center">
                        <p class="text-sm font-bold text-dark/20 uppercase tracking-widest">No partners found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
