@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="max-w-[800px] mx-auto py-20 text-center space-y-12">
    {{-- Success Animation / Icon --}}
    <div class="relative inline-block">
        <div class="w-32 h-32 bg-green-500 rounded-[2.5rem] flex items-center justify-center text-white shadow-2xl shadow-green-500/20 animate-bounce">
            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div class="absolute -inset-4 bg-green-500/20 rounded-full blur-3xl animate-pulse -z-10"></div>
    </div>

    {{-- Content --}}
    <div class="space-y-4">
        <h1 class="text-4xl font-black text-dark tracking-tighter">Order Successfully Placed!</h1>
        <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] max-w-sm mx-auto leading-loose italic">
            Your nutritious meal package is now being prepared with heritage care.
        </p>
    </div>

    {{-- Info Box --}}
    <div class="bg-white rounded-3xl p-10 border border-black/5 shadow-sm space-y-8">
        <div class="flex items-center justify-center space-x-8">
            <div class="text-center">
                <p class="text-[10px] font-black uppercase tracking-widest text-dark/20 mb-1">Status</p>
                <p class="text-sm font-black text-green-600 uppercase tracking-widest">Processing</p>
            </div>
            <div class="w-px h-8 bg-black/5"></div>
            <div class="text-center">
                <p class="text-[10px] font-black uppercase tracking-widest text-dark/20 mb-1">Est. Delivery</p>
                <p class="text-sm font-black text-dark uppercase tracking-widest italic">Today</p>
            </div>
        </div>
        
        <p class="text-xs text-dark/50 font-medium leading-relaxed">
            Our heritage partners have been notified. You can track your delivery progress live from your dashboard.
        </p>
    </div>

    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="{{ route('member.dashboard') }}" class="w-full sm:w-auto px-10 py-5 bg-dark text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-dark/10 hover:bg-primary hover:text-dark transition-all transform hover:scale-105">
            Back to Dashboard
        </a>
        <a href="{{ route('member.meals.menu') }}" class="w-full sm:w-auto px-10 py-5 bg-white border border-black/10 text-dark rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-dark hover:text-white transition-all transform hover:scale-105">
            Order Another Meal
        </a>
    </div>
</div>
@endsection
