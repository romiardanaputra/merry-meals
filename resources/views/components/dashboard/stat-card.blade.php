{{--
    Stat Card Component
    Unified statistics card with color variants, icon support, or gauge visual
--}}
@props([
    'label',
    'value',
    'icon' => null,
    'color' => 'default',
    'subtitle' => null,
    'percentage' => null, // If set, displays the Gauge visual instead of icon
])

@php
    $colorClasses = match($color) {
        'primary' => 'bg-[#FF7B54] text-[#222222] shadow-[#FF7B54]/20',
        'success' => 'bg-green-500 text-white shadow-green-500/20',
        'warning' => 'bg-amber-500 text-[#222222] shadow-amber-500/20',
        'dark' => 'bg-[#222222] text-white shadow-[#222222]/20',
        'info' => 'bg-blue-500 text-white shadow-blue-500/20',
        'danger' => 'bg-red-500 text-white shadow-red-500/20',
        default => 'bg-white text-[#222222] border border-black/5 shadow-black/5',
    };
    
    $iconBg = match($color) {
        'primary', 'warning' => 'bg-[#222222]/10',
        'success', 'info', 'danger', 'dark' => 'bg-white/20',
        default => 'bg-[#FF7B54]/10',
    };

    $gaugeColorClass = match($color) {
        'primary' => 'border-[#222222]',
        'success' => 'border-white',
        'warning' => 'border-[#222222]',
        'dark' => 'border-[#FF7B54]',
        default => 'border-[#FF7B54]'
    };

    // Handle icon
    $icons = config('dashboard.icons', []);
    
    if ($icon instanceof \Illuminate\View\ComponentSlot) {
        $iconContent = $icon;
    } elseif (is_string($icon)) {
        $iconContent = $icons[$icon] ?? $icon;
    } else {
        $iconContent = null;
    }

    $clipPathStyle = $percentage !== null ? "clip-path: inset(0 " . (100 - (min(100, max(0, $percentage)))) . "% 0 0); transform-origin: bottom center;" : "";
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl p-8 shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl {$colorClasses} animate-on-scroll"]) }}>
    <div class="flex items-start justify-between min-h-[90px]">
        <div class="space-y-4 flex-1">
            <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-50">{{ $label }}</span>
            <div class="space-y-1">
                <h2 class="text-4xl font-black tracking-tighter">{{ $value }}</h2>
                @if($subtitle)
                    <p class="text-[11px] font-bold opacity-60 italic">{{ $subtitle }}</p>
                @endif
            </div>
        </div>

        @if($percentage !== null)
            {{-- Gauge Visual --}}
            <div class="relative w-24 h-12 overflow-hidden flex-shrink-0 mt-2">
                <div class="absolute inset-0 border-[8px] opacity-10 border-current rounded-t-full"></div>
                @php
                    $gaugeStyle = 'style="' . $clipPathStyle . '"';
                @endphp
                <div class="absolute inset-0 border-[8px] {{ $gaugeColorClass }} rounded-t-full transition-all duration-1000" 
                     {!! $gaugeStyle !!}></div>
                <div class="absolute bottom-0 w-full text-center">
                    <span class="text-[11px] font-black italic">+{{ $percentage }}% ↑</span>
                </div>
            </div>
        @elseif($iconContent)
            {{-- Icon Visual --}}
            <div class="w-14 h-14 {{ $iconBg }} rounded-2xl flex items-center justify-center flex-shrink-0">
                @if($iconContent instanceof \Illuminate\View\ComponentSlot)
                    {{ $iconContent }}
                @elseif(is_string($iconContent) && str_contains($iconContent, '<'))
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconContent !!}
                    </svg>
                @else
                    {{ $iconContent }}
                @endif
            </div>
        @endif
    </div>
    
    <div class="mt-8 flex items-center space-x-2 opacity-30">
        <div class="w-2 h-2 rounded-full bg-current animate-pulse"></div>
        <span class="text-[9px] font-black uppercase tracking-widest">Live Updates Active</span>
    </div>
</div>
