<section class="relative h-[90svh] xl:h-[95lvh] flex items-center overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('storage/images/landingSalad.png') }}" alt="Fresh Salad" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-dark/90 via-dark/60 to-transparent"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-2xl space-y-8">
            <div class="space-y-4">
                <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary rounded-full text-sm font-bold tracking-wide animate-fade-in">
                    Nourishing Communities Since 2024
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-[#FFFDF6] leading-[1.1] tracking-tight hero-title">
                    Healthy Meals Cooked for <span class="text-primary italic">Everyone.</span>
                </h1>
                <p class="text-lg md:text-xl text-[#FFFDF6]/80 font-medium max-w-lg leading-relaxed hero-subtitle">
                    Thousands of volunteers and caregivers are ready to help vulnerable seniors and people with disabilities across the nation.
                </p>
            </div>

            <div class="flex flex-wrap gap-4 pt-4 hero-cta">
                <a href="#serve" class="px-8 py-4 bg-primary text-dark font-bold rounded-xl shadow-lg shadow-primary/30 hover:scale-105 transition-all duration-300">
                    Get Free Meals
                </a>
                <a href="{{ route('about') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold rounded-xl hover:bg-white/20 transition-all duration-300">
                    Our Mission
                </a>
            </div>
        </div>
    </div>

    <!-- Decorative Glow -->
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/10 rounded-full blur-[120px]"></div>
</section>
