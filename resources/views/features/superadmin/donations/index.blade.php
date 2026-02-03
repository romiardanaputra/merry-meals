{{-- Superadmin Donations Index View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#222222] tracking-tight">Donation Management</h1>
            <p class="text-sm text-gray-500 mt-1">View all platform donations</p>
        </div>
        <a href="{{ route('superadmin.donations.export') }}" 
           class="inline-flex items-center px-6 py-3 bg-[#222222] text-white rounded-xl font-bold text-sm hover:bg-[#222222]/90 transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export CSV
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gradient-to-br from-[#FF7B54] to-[#FF7B54]/80 rounded-2xl p-6 text-white">
            <p class="text-xs font-bold uppercase tracking-wider opacity-70">Total Donations</p>
            <p class="text-3xl font-black mt-2">${{ number_format($totalDonations) }}</p>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Number of Donors</p>
            <p class="text-3xl font-black mt-2 text-[#222222]">{{ number_format($donationCount) }}</p>
        </div>
    </div>

    {{-- Donations Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Donor</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($donations as $donation)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-gray-600">#{{ $donation->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#FF7B54]/10 flex items-center justify-center">
                                        <span class="text-[#FF7B54] font-bold text-sm">{{ strtoupper(substr($donation->donatorName ?? 'A', 0, 1)) }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-[#222222]">{{ $donation->donatorName ?? 'Anonymous' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $donation->donatorEmail ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-green-600">${{ number_format($donation->donationAmount) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $donation->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <p class="font-medium">No donations yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($donations->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $donations->links('partials.custom-pagination') }}
            </div>
        @endif
    </div>
@endsection
