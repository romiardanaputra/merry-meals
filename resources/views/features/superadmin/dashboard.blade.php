@extends('layouts.main')

@section('component_content')
<main class="min-h-screen bg-background-soft font-inter">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-12">
            <div class="space-y-2">
                <h1 class="text-h2 text-dark font-black tracking-tighter">Superadmin Control</h1>
                <p class="text-xl text-dark/40 font-medium">System-wide monitoring and configurations.</p>
            </div>
            <div class="px-6 py-3 bg-red-500/10 text-red-500 rounded-2xl text-xs font-black uppercase tracking-widest border border-red-500/20">
                Level 1 Access
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Stat Cards -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40">
                <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-4">Total Users</h3>
                <p class="text-h2 text-dark">0</p>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40">
                <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-4">System Health</h3>
                <p class="text-h2 text-primary">100%</p>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/40">
                <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-4">Audit Logs</h3>
                <p class="text-h2 text-dark">View All</p>
            </div>
        </div>
    </div>
</main>
@endsection
