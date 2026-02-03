@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="max-w-[1200px] space-y-12">
    {{-- Back Button --}}
    <div>
        <a href="{{ route('member.meals.detail', $meal->id) }}" class="inline-flex items-center space-x-3 text-dark/40 hover:text-dark transition-colors group">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm border border-black/5 group-hover:bg-dark group-hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest">Back to Meal Details</span>
        </a>
    </div>

    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-black text-dark tracking-tighter">Select Your Package</h1>
        <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2 italic">Choose a delivery frequency for <span class="text-dark">{{ $meal->mealName }}</span></p>
    </div>

    {{-- Package Options --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
            $packages = [
                ['name' => 'Single Delivery', 'duration' => '1 Day', 'description' => 'One-time delivery for trying our service', 'value' => '1day', 'icon' => 'M5 13l4 4L19 7'],
                ['name' => 'Weekly Package', 'duration' => '7 Days', 'description' => 'Receive meals every day for a week', 'value' => '7days', 'popular' => true, 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                ['name' => 'Monthly Package', 'duration' => '30 Days', 'description' => 'Full month of nutritious meals delivered daily', 'value' => '30days', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ];
        @endphp

        @foreach($packages as $package)
        <form action="{{ route('member.meals.order') }}" method="POST" class="h-full">
            @csrf
            <input type="hidden" name="mealID" value="{{ $meal->id }}">
            <input type="hidden" name="partnerID" value="{{ $meal->partnerID }}">
            <input type="hidden" name="package" value="{{ $package['value'] }}">
            
            <button type="submit" class="w-full h-full text-left group">
                <div class="bg-white rounded-[2.5rem] p-10 border-2 {{ isset($package['popular']) ? 'border-primary shadow-xl shadow-primary/10' : 'border-black/5' }} group-hover:border-primary group-hover:shadow-2xl group-hover:shadow-primary/10 transition-all duration-700 flex flex-col h-full relative overflow-hidden">
                    @if(isset($package['popular']))
                        <div class="absolute top-0 right-0 bg-primary text-dark px-6 py-2 rounded-bl-2xl text-[10px] font-black uppercase tracking-widest">Most Popular</div>
                    @endif
                    
                    <div class="w-16 h-16 bg-dark/5 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary/10 transition-colors">
                        <svg class="w-8 h-8 text-dark/40 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $package['icon'] }}" />
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-black text-dark tracking-tighter mb-2">{{ $package['name'] }}</h3>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-primary mb-6">{{ $package['duration'] }} Duration</p>
                    <p class="text-sm text-dark/50 font-medium leading-relaxed flex-1 italic">"{{ $package['description'] }}"</p>
                    
                    <div class="mt-10 pt-8 border-t border-black/5">
                        <span class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-dark group-hover:text-primary transition-colors">
                            Complete Order
                            <svg class="w-4 h-4 ml-3 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </button>
        </form>
        @endforeach
    </div>
</div>
@endsection
