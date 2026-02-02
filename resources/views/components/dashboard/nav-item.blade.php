{{--
    Navigation Item Component
    Single nav item for sidebar/drawer
    
    Props:
    - $route: Route name
    - $label: Display label
    - $icon: Icon key or SVG
    - $badge: Optional badge count
--}}
@props([
    'route',
    'label',
    'icon' => null,
    'badge' => null,
])

@php
    $isActive = request()->routeIs($route);
    $icons = config('dashboard.icons', []);
    $iconPath = is_string($icon) ? ($icons[$icon] ?? '') : '';
@endphp

<a 
    href="{{ route($route) }}" 
    {{ $attributes->merge([
        'class' => "flex items-center space-x-4 px-5 py-4 rounded-xl transition-all duration-300 group " . 
            ($isActive 
                ? 'bg-[#FF7B54] text-[#222222] shadow-lg shadow-[#FF7B54]/20' 
                : 'text-white/60 hover:bg-white/5 hover:text-white')
    ]) }}
>
    @if($iconPath)
        <svg class="w-5 h-5 {{ $isActive ? 'text-[#222222]' : 'text-white/40 group-hover:text-white' }}" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $iconPath !!}
        </svg>
    @endif
    <span class="text-[11px] font-black uppercase tracking-widest flex-1">{{ $label }}</span>
    @if($badge)
        <span class="bg-red-500 text-white text-[9px] font-bold px-2 py-1 rounded-full">
            {{ $badge }}
        </span>
    @endif
</a>
