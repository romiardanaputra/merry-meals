@props(['id', 'title'])

<section id="{{ $id }}" {{ $attributes->merge(['class' => 'doc-section']) }}>
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-bold tracking-tight mb-8 text-foreground">{{ $title }}</h2>
        <div class="animate-on-scroll">
            {{ $slot }}
        </div>
    </div>
</section>
