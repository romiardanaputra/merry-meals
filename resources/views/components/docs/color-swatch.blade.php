@props(['color', 'name', 'hex'])

<div class="flex items-center gap-4 p-4 border border-border rounded-xl bg-card">
    <div class="h-12 w-12 rounded-lg shadow-inner border border-black/5" style="background-color: {{ $hex }}"></div>
    <div class="flex flex-col">
        <span class="font-bold text-foreground">{{ $name }}</span>
        <span class="text-xs font-mono text-muted-foreground uppercase">{{ $hex }}</span>
        <span class="text-[10px] text-muted-foreground/60 mt-1">var(--{{ $color }})</span>
    </div>
</div>
