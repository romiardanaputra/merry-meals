@php
    $colorClass = match($color) {
        'primary' => 'text-[#FF7B54]',
        'black' => 'text-[#222222]',
        'green' => 'text-[#4CAF3C]',
        default => 'text-[#FF7B54]'
    };
    
    // Pre-calculate style string to avoid Blade/Linter parsing issues with inline style braces
    $clipPathStyle = "clip-path: inset(0 " . (100 - $percentage) . "% 0 0); transform-origin: bottom center;";
    $borderColorClass = str_replace('text-', 'border-', $colorClass);
    // Create the full style attribute to prevent "at-rule or selector expected" IDE errors
    $styleAttribute = 'style="' . $clipPathStyle . '"';
@endphp

<div class="bg-white rounded-xl p-10 shadow-sm border border-black/5 hover:shadow-xl transition-all duration-500 group animate-on-scroll">
    <div class="flex justify-between items-start mb-10">
        <div class="space-y-2">
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">{{ $label }}</span>
            <div class="flex items-baseline space-x-1">
                <span class="text-[14px] font-black text-dark/40">This month</span>
            </div>
            <h2 class="text-[32px] font-black text-dark tracking-tighter">{{ $value }}</h2>
        </div>
        
        <!-- Gauge Visual -->
        <div class="relative w-24 h-12 overflow-hidden">
            <div class="absolute inset-0 border-[8px] border-dark/5 rounded-t-full"></div>
            <div class="absolute inset-0 border-[8px] {{ $borderColorClass }} rounded-t-full transition-all duration-1000" 
                 {!! $styleAttribute !!}></div>
            <div class="absolute bottom-0 w-full text-center">
                <span class="{{ $colorClass }} text-[12px] font-black italic">+{{ $percentage }}% ↑</span>
            </div>
        </div>
    </div>
    
    <div class="flex items-center space-x-2">
        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
        <span class="text-[10px] font-black uppercase tracking-widest text-dark/20">Live metrics updated</span>
    </div>
</div>
