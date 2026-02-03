{{-- Member Order Success View --}}
@extends('layouts.main')

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter p-4 sm:p-8 lg:p-12 flex items-center justify-center">
    <div class="max-w-lg mx-auto text-center">
        {{-- Success Icon --}}
        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-green-500/30">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-3xl font-black text-dark tracking-tighter mb-4">Order Placed Successfully!</h1>
        <p class="text-dark/60 font-medium mb-8">Your meal order has been received. A driver will be assigned to deliver your nutritious meal soon.</p>

        {{-- Order Info Card --}}
        <div class="bg-white rounded-2xl p-6 border border-black/5 shadow-sm mb-8">
            <div class="flex items-center justify-between text-sm">
                <span class="text-dark/40 font-medium">Status</span>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold uppercase">Pending</span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('member.dashboard') }}" 
               class="px-8 py-4 bg-dark text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-dark/10 hover:bg-primary hover:text-dark transition-all">
                Go to Dashboard
            </a>
            <a href="{{ route('member.meals.menu') }}" 
               class="px-8 py-4 bg-white text-dark rounded-2xl font-black text-xs uppercase tracking-widest border border-black/10 hover:border-black/20 transition-all">
                Order Another Meal
            </a>
        </div>
    </div>
</main>
@endsection
