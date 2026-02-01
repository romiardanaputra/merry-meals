@extends('layout.main')

@section('component_content')
<main class="min-h-screen bg-background-soft font-inter">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div class="space-y-2">
                <h1 class="text-h2 text-dark font-black tracking-tighter">Member Dashboard</h1>
                <p class="text-xl text-dark/40 font-medium">Find your next nutritious meal.</p>
            </div>
            <a href="{{ route('donation') }}" class="px-8 py-4 bg-primary text-white text-h6 font-black rounded-2xl shadow-xl hover:scale-105 active:scale-95 transition-all text-center">
                Donate Now
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Quick Actions -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40 flex flex-col items-center text-center space-y-6">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-dark tracking-tight">Browse Menu</h3>
                    <p class="text-dark/40 font-medium">Explore available healthy meal packs.</p>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40 flex flex-col items-center text-center space-y-6">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-dark tracking-tight">Order Status</h3>
                    <p class="text-dark/40 font-medium">Track your current meal deliveries.</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection