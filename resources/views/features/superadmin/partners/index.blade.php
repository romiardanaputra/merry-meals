{{-- Superadmin Partners Index View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#222222] tracking-tight">Partner Management</h1>
            <p class="text-sm text-gray-500 mt-1">Review and manage restaurant partners</p>
        </div>
        <div class="flex items-center space-x-3">
            <form action="{{ route('superadmin.partners.index') }}" method="GET" class="flex items-center space-x-2">
                <select name="status" onchange="this.form.submit()" 
                        class="px-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent">
                    <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
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

    {{-- Partners Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($partners as $partner)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                {{-- Restaurant Image --}}
                <div class="h-40 bg-gray-100 relative">
                    @if($partner->restaurantImage)
                        <img src="{{ asset('storage/' . $partner->restaurantImage) }}" 
                             alt="{{ $partner->restaurantName }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    @endif
                    @php
                        $statusColors = [
                            'pending' => 'bg-amber-500',
                            'approved' => 'bg-green-500',
                            'rejected' => 'bg-red-500',
                            'suspended' => 'bg-gray-500',
                        ];
                    @endphp
                    <span class="absolute top-3 right-3 px-3 py-1 rounded-lg text-xs font-bold text-white {{ $statusColors[$partner->status] ?? 'bg-gray-500' }}">
                        {{ ucfirst($partner->status ?? 'pending') }}
                    </span>
                </div>
                
                {{-- Content --}}
                <div class="p-5">
                    <h3 class="font-bold text-lg text-[#222222] mb-1">{{ $partner->restaurantName }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ $partner->ownerName }}</p>
                    <p class="text-xs text-gray-400 line-clamp-2 mb-4">{{ $partner->restaurantAddress }}</p>
                    
                    {{-- Actions --}}
                    <div class="flex flex-wrap gap-2">
                        @if($partner->status === 'pending')
                            <form action="{{ route('superadmin.partners.approve', $partner) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg text-xs font-bold hover:bg-green-600 transition-colors">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('superadmin.partners.reject', $partner) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg text-xs font-bold hover:bg-red-600 transition-colors">
                                    Reject
                                </button>
                            </form>
                        @elseif($partner->status === 'approved')
                            <form action="{{ route('superadmin.partners.suspend', $partner) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-lg text-xs font-bold hover:bg-gray-600 transition-colors">
                                    Suspend
                                </button>
                            </form>
                        @elseif($partner->status === 'suspended')
                            <form action="{{ route('superadmin.partners.approve', $partner) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg text-xs font-bold hover:bg-green-600 transition-colors">
                                    Reactivate
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('superadmin.partners.destroy', $partner) }}" method="POST" 
                              onsubmit="return confirm('Delete this partner permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <p class="font-medium">No partners found</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($partners->hasPages())
        <div class="mt-8">
            {{ $partners->withQueryString()->links() }}
        </div>
    @endif
@endsection
