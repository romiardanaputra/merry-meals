@extends('layout.main')

@section('component_content')
<main class="min-h-screen bg-background-soft font-inter">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-12">
            <div class="space-y-2">
                <h1 class="text-h2 text-dark font-black tracking-tighter">Kitchen Dashboard</h1>
                <p class="text-xl text-dark/40 font-medium">Manage your meals and prep status.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40 text-center">
                <h3 class="text-xs font-black uppercase tracking-widest text-dark/40">New Orders</h3>
                <p class="text-h2 text-primary italic">0</p>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40 text-center">
                <h3 class="text-xs font-black uppercase tracking-widest text-dark/40">Preparing</h3>
                <p class="text-h2 text-dark">0</p>
            </div>
        </div>
    </div>
</main>
@endsection