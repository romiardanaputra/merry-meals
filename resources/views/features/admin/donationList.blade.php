@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/40 overflow-hidden">
    <div class="p-8 border-b border-border/40 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-dark tracking-tight">Donation History</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-widest mt-1">Detailed Log of Financial Contributions</p>
        </div>
    </div>

    @include('features.admin.partials.donation-table')
</div>
@endsection