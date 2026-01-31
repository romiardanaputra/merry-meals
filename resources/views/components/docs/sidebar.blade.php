@props(['links'])

<aside class="fixed left-0 top-0 h-full w-64 border-r border-border bg-card p-6 overflow-y-auto hidden lg:block">
    <div class="mb-10 flex items-center gap-3">
        <div class="h-10 w-10 rounded-lg bg-primary flex items-center justify-center text-dark font-bold text-xl">M</div>
        <h2 class="text-xl font-bold tracking-tight text-foreground">Merry Meals</h2>
    </div>

    <nav class="space-y-2">
        <p class="px-4 text-xs font-bold uppercase tracking-widest text-muted-foreground/60 mb-3">Documentation</p>
        @foreach($links as $id => $label)
            <a href="#{{ $id }}" class="sidebar-link">
                <span class="text-sm">{{ $label }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto pt-10 border-t border-border/50">
        <p class="px-4 text-[10px] text-muted-foreground/50">© 2026 Merry Meals v1.0</p>
    </div>
</aside>
