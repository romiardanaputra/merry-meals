{{--
    Stat Card Component
    Reusable statistics card with color variants
    Based on DASHBOARD_ARCHITECTURE.md specifications

    Props:
    - $label: Card label text
    - $value: Main value to display
    - $icon: SVG icon slot or path
    - $color: Color variant (primary, success, warning, dark, default)
    - $subtitle: Optional subtitle text
--}}
@props([
    'label',
    'value',
    'icon' => null,
    'color' => 'default',
    'subtitle' => null,
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

    // Handle icon - could be a slot (ComponentSlot), a config key, or direct SVG content
    $icons = config('dashboard.icons', []);
    
    // If $icon is a ComponentSlot (passed via x-slot:icon), use it directly
    if ($icon instanceof \Illuminate\View\ComponentSlot) {
        $iconContent = $icon;
    } elseif (is_string($icon)) {
        // Lookup icon from config if it's a known key
        $iconContent = $icons[$icon] ?? $icon;
    } else {
        $iconContent = null;
    }
@endphp

<div {{ $attributes->merge(['class' => "rounded-xl p-6 md:p-8 shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-xl {$colorClasses}"]) }}>
    <div class="flex items-start justify-between">
        <div class="space-y-1 flex-1">
            <span class="text-[10px] font-black uppercase tracking-wider opacity-60">{{ $label }}</span>
            <h2 class="text-3xl md:text-4xl font-black tracking-tighter">{{ $value }}</h2>
            @if($subtitle)
                <p class="text-[11px] font-bold opacity-60">{{ $subtitle }}</p>
            @endif
        </div>
        @if($iconContent)
            <div class="w-12 h-12 {{ $iconBg }} rounded-2xl flex items-center justify-center flex-shrink-0">
                @if($iconContent instanceof \Illuminate\View\ComponentSlot)
                    {{-- Render slot content directly --}}
                    {{ $iconContent }}
                @elseif(is_string($iconContent) && str_contains($iconContent, '<'))
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconContent !!}
                    </svg>
                @else
                    {{ $iconContent }}
                @endif
            </div>
        @endif
    </div>
</div>
