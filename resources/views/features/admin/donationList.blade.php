@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
        <div>
            <h2 class="text-2xl font-black text-dark tracking-tight">Donation History</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-[0.2em] mt-1">Detailed log of financial contributions and community support</p>
        </div>
    </div>

    @include('features.admin.partials.donation-table')
</div>
@endsection