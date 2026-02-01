@extends('layout.main')

@section('component_content')
<main class="min-h-screen bg-background-soft font-inter">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-12">
            <div class="space-y-2">
                <h1 class="text-h2 text-dark font-black tracking-tighter">Driver Portal</h1>
                <p class="text-xl text-dark/40 font-medium">Pick up and deliver nutrition to elders.</p>
            </div>
        </div>

        <div class="bg-white p-12 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40 text-center space-y-6">
            <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center text-primary mx-auto">
                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-dark tracking-tight">No Active Deliveries</h3>
            <p class="text-dark/40 font-medium max-w-md mx-auto italic">Slide to "Available" to start receiving delivery requests from nearby kitchens.</p>
        </div>
    </div>
</main>
@endsection