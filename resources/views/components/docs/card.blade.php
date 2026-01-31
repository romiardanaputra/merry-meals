@props(['title', 'icon' => null])

<div class="doc-card glass-card p-6 bg-card flex flex-col gap-4 shadow-sm hover:shadow-md hover:border-primary/30 transition-all duration-300">
    <div class="flex items-center gap-3">
        @if($icon)
            <div class="h-10 w-10 rounded-lg bg-primary/20 flex items-center justify-center text-primary">
                {!! $icon !!}
            </div>
        @endif
        <h3 class="font-bold text-lg text-foreground">{{ $title }}</h3>
    </div>
    <div class="text-sm text-muted-foreground leading-relaxed">
        {{ $slot }}
    </div>
</div>
