@props(['title', 'subtitle'])

<section id="hero" class="doc-section flex flex-col items-center justify-center text-center py-24 min-h-[60vh] bg-gradient-to-b from-primary/10 to-transparent">
    <div class="max-w-3xl space-y-6">
        <h1 class="hero-title text-4xl font-extrabold tracking-tight sm:text-6xl text-foreground">
            {{ $title }}
        </h1>
        <p class="hero-subtitle text-xl text-muted-foreground leading-relaxed">
            {{ $subtitle }}
        </p>
        <div class="hero-cta flex flex-wrap justify-center gap-4 pt-4">
            <a href="#overview" class="px-8 py-3 bg-primary text-dark font-bold rounded-lg hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                Get Started
            </a>
            <a href="https://github.com/yudantaa/merry-meals" class="px-8 py-3 bg-white border border-border text-foreground font-semibold rounded-lg hover:bg-muted transition-colors">
                View Source
            </a>
        </div>
    </div>
</section>
