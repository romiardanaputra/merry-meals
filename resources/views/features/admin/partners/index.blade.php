@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
        <div>
            <h2 class="text-2xl font-black text-dark tracking-tight">Partner Management</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-[0.2em] mt-1">Review and manage authorized restaurant partners</p>
        </div>
    </div>

    {{-- Header Row (Desktop) --}}
    <div class="hidden lg:grid grid-cols-12 px-8 py-3 bg-gray-50/50 rounded-xl mb-4">
        <div class="col-span-4 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Partner Identity</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Ownership</div>
        <div class="col-span-2 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Specialization</div>
        <div class="col-span-1 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Status</div>
        <div class="col-span-2 text-right text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Actions</div>
    </div>

    <div class="space-y-4">
        @forelse($partners as $partner)
        <div class="bg-white rounded-2xl p-6 lg:p-0 lg:px-8 lg:py-6 flex flex-col lg:grid lg:grid-cols-12 items-center gap-6 lg:gap-0 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 group border border-transparent hover:border-primary/10">
            {{-- Partner Identity --}}
            <div class="lg:col-span-4 w-full flex items-center space-x-6">
                <div class="w-16 h-16 rounded-2xl bg-dark/5 flex items-center justify-center overflow-hidden border border-black/5 group-hover:scale-105 transition-transform duration-500 flex-shrink-0">
                    @if($partner->restaurantImage)
                        <img src="{{ asset('storage/'.$partner->restaurantImage) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-dark/10 text-3xl font-black uppercase">{{ substr($partner->restaurantName, 0, 1) }}</span>
                    @endif
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="text-base font-black text-dark tracking-tight truncate">{{ $partner->restaurantName }}</span>
                    <span class="text-[10px] font-bold text-dark/40 uppercase tracking-tighter truncate">{{ $partner->restaurantAddress }}</span>
                </div>
            </div>

            {{-- Ownership --}}
            <div class="lg:col-span-3 w-full">
                <div class="flex flex-col">
                    <span class="text-sm font-black text-dark/80 tracking-tight">{{ $partner->ownerName }}</span>
                    <span class="text-[10px] font-bold text-dark/30 uppercase tracking-widest">{{ $partner->restaurantContact }}</span>
                </div>
            </div>

            {{-- Specialization --}}
            <div class="lg:col-span-2 w-full">
                <span class="px-4 py-1.5 bg-primary/5 text-primary text-[9px] font-black uppercase rounded-xl tracking-widest border border-primary/10">
                    {{ $partner->foodType }}
                </span>
            </div>

            {{-- Status --}}
            <div class="lg:col-span-1 w-full">
                @php
                    $statusColor = [
                        'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                        'approved' => 'bg-green-100 text-green-700 border-green-200',
                        'rejected' => 'bg-red-100 text-red-700 border-red-200',
                    ][$partner->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                @endphp
                <span class="px-4 py-1.5 {{ $statusColor }} text-[8px] font-black uppercase rounded-lg tracking-[0.2em] border shadow-sm">
                    {{ $partner->status }}
                </span>
            </div>

            {{-- Actions --}}
            <div class="lg:col-span-2 w-full">
                <div class="flex items-center lg:justify-end gap-2">
                    @if($partner->status === 'pending')
                    <form action="{{ route('admin.partners.approve', $partner->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-10 h-10 bg-green-500/10 text-green-600 rounded-xl flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm" title="Approve Partner">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        </button>
                    </form>
                    <form action="{{ route('admin.partners.reject', $partner->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-10 h-10 bg-red-500/10 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm" title="Reject Partner">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Silahkan konfirmasi penghapusan partner ini.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-dark/5 text-dark/20 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm" title="Delete Partner">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-black/5">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <p class="text-sm font-black text-dark/20 uppercase tracking-[0.3em]">No restaurant partners found</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8 px-4">
        {{ $partners->links('partials.custom-pagination') }}
    </div>
</div>
@endsection
