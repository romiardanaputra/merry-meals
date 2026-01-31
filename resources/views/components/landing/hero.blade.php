<section class="relative min-h-[600px] lg:h-[100vh] flex items-center overflow-hidden bg-dark font-inter">
    <!-- Background Image with Clean Overlay -->
    <div class="absolute inset-0 z-0 opacity-60">
        <img src="{{ asset('storage/images/landingSalad.png') }}" alt="Fresh Salad" class="w-full h-full object-cover grayscale-[20%]">
        <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/40 to-transparent"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl space-y-6 md:space-y-8">
            <div class="space-y-4 md:space-y-6">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary/10 border border-primary/20 text-primary rounded-full text-xs md:text-sm font-black tracking-widest uppercase animate-fade-in">
                    <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                    Nourishing Communities Since 2024
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white leading-[0.95] tracking-tighter hero-title">
                    Healthy Meals <br class="hidden md:block"/>
                    Cooked for <span class="text-primary">Everyone.</span>
                </h1>
                <p class="text-lg md:text-xl text-white/70 font-medium max-w-xl leading-relaxed hero-subtitle">
                    Thousands of volunteers and caregivers are ready to help vulnerable seniors and people with disabilities across the nation.
                </p>
            </div>

            <div class="flex flex-wrap gap-5 pt-4 hero-cta">
                <a href="#serve" class="px-10 py-5 bg-primary text-dark font-black text-lg rounded-2xl shadow-2xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all duration-300">
                    Get Free Meals
                </a>
                <a href="{{ route('about') }}" class="px-10 py-5 bg-white/5 backdrop-blur-md border border-white/10 text-white font-bold text-lg rounded-2xl hover:bg-white/10 transition-all duration-300">
                    Our Mission
                </a>
            </div>
        </div>
    </div>

    <!-- Decorative Glow -->
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/10 rounded-full blur-[120px]"></div>
</section>
