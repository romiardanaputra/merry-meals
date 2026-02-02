{{-- Driver Stat Card Component --}}
@props(['label', 'value', 'icon', 'color' => 'primary', 'subtitle' => null])

@php
    $colorClasses = match($color) {
        'primary' => 'bg-primary text-dark shadow-primary/20',
        'success' => 'bg-green-500 text-white shadow-green-500/20',
        'warning' => 'bg-amber-500 text-dark shadow-amber-500/20',
        'dark' => 'bg-dark text-white shadow-dark/20',
        default => 'bg-white text-dark shadow-dark/5 border border-black/5'
    };
    
    $iconBgClass = match($color) {
        'primary' => 'bg-white/20',
        'success' => 'bg-white/20',
        'warning' => 'bg-white/20',
        'dark' => 'bg-white/10',
        default => 'bg-dark/5 group-hover:bg-dark group-hover:text-white'
    };
@endphp

<div class="rounded-xl p-8 shadow-lg {{ $colorClasses }} hover:scale-[1.02] transition-all duration-500 relative overflow-hidden group">
    <div class="flex justify-between items-start mb-4 relative z-10">
        <div class="space-y-1">
            <span class="text-[10px] font-black uppercase tracking-wider opacity-60">{{ $label }}</span>
            <h2 class="text-4xl font-black tracking-tighter">{{ $value }}</h2>
            @if($subtitle)
                <p class="text-[11px] font-bold opacity-60 mt-2">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="w-12 h-12 {{ $iconBgClass }} rounded-2xl flex items-center justify-center transition-all duration-300">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $icon }}" />
            </svg>
        </div>
    </div>
    
    {{-- Decorative blur element for colored cards --}}
    @if($color !== 'default')
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
    @endif
</div>
