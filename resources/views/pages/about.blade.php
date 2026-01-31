<x-app-layout>
     @section('css_custom')
        @vite(['resources/css/docs.css'])
        <style>
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .animate-bounce-slow {
                animation: bounce-slow 3s infinite ease-in-out;
            }
        </style>
    @endsection
    <div class="bg-background-soft font-inter overflow-x-hidden">
        
        <!-- Section 1: Hero / Our Mission -->
        <section class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 overflow-hidden">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                    <!-- Text Content (Z-Pattern: Left) -->
                    <div class="w-full lg:w-1/2 space-y-8 animate-on-scroll">
                        <div class="space-y-4">
                            <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-black uppercase tracking-[0.2em] rounded-full">Our Purpose</span>
                            <h1 class="font-black text-dark tracking-tighter leading-[1.1]">
                                Nourishing <span class="italic text-primary">Hope</span>, One Meal at a Time.
                            </h1>
                        </div>
                        <p class="text-lg md:text-xl text-foreground/70 leading-relaxed font-medium">
                            The most vulnerable elderly and individuals with disabilities in Indonesia are presently confronting extreme food insecurity. Merry Meals continues to expand to satisfy the rising need for healthy and inexpensive meals.
                        </p>
                        <div class="pt-4">
                            <a href="{{ route('donation') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-dark text-white font-black rounded-2xl shadow-2xl hover:scale-105 active:scale-95 transition-all group">
                                Support Our Mission
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Image Content (Z-Pattern: Right) -->
                    <div class="w-full lg:w-1/2 relative animate-on-scroll">
                        <div class="absolute inset-0 bg-primary/20 blur-[100px] rounded-full -z-10 animate-pulse-slow"></div>
                        <div class="relative rounded-[2.5rem] overflow-hidden border border-border/50 shadow-3xl">
                            <img src="{{ asset('storage/images/peopleGathering.jpg') }}" alt="Community Gathering" class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700" loading="lazy" />
                        </div>
                        <!-- Floating Badge -->
                        <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl border border-border/10 max-w-[240px] hidden md:block animate-bounce-slow">
                            <p class="text-sm font-bold text-dark italic">"Empowering the community through nutritional dignity."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: What is Merry Meals (Visual Switch / F-Pattern) -->
        <section class="py-20 lg:py-32 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col flex-col-reverse lg:flex-row items-center gap-12 lg:gap-20">
                    <!-- Image Content (Left) -->
                    <div class="w-full lg:w-1/2 grid grid-cols-2 gap-4 animate-on-scroll">
                        <div class="space-y-4">
                            <div class="rounded-3xl overflow-hidden shadow-lg h-64">
                                <img src="{{ asset('storage/images/aboutUsImage.jpg') }}" class="w-full h-full object-cover" loading="lazy" />
                            </div>
                            <div class="bg-primary rounded-3xl p-8 h-40 flex items-center justify-center text-dark font-black text-2xl text-center">
                                Established with Love
                            </div>
                        </div>
                        <div class="pt-12 space-y-4">
                            <div class="bg-dark rounded-3xl p-8 h-48 flex items-center justify-center text-white font-black text-3xl text-center">
                                100% Local Impact
                            </div>
                            <div class="rounded-3xl overflow-hidden shadow-lg h-56">
                                <img src="{{ asset('storage/images/donation-8.jpg') }}" class="w-full h-full object-cover" loading="lazy" />
                            </div>
                        </div>
                    </div>

                    <!-- Text Content (Right) -->
                    <div class="w-full lg:w-1/2 space-y-8 animate-on-scroll">
                        <div class="space-y-4">
                            <span class="text-primary font-black uppercase tracking-widest text-xs">Our Identity</span>
                            <h2 class="text-h2 font-black text-dark tracking-tighter leading-tight">
                                What is <span class="text-primary">Merry Meals</span>?
                            </h2>
                        </div>
                        <div class="space-y-6 text-foreground/70 text-lg leading-relaxed font-medium">
                            <p>
                                Merry Meals provides healthy, tasty, and affordable meals to diverse populations, including the elderly, those with physical or cognitive challenges, and patients recovering from surgery.
                            </p>
                            <p>
                                Launched by local groups in Indonesia, our programs are deeply rooted in the communities they serve. From hot, ready-to-eat meals to specialized nutritional support, we adapt to the unique needs of every neighborhood.
                            </p>
                            <div class="flex items-start gap-4 p-6 bg-background-soft rounded-2xl border border-border/20">
                                <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-dark italic leading-snug">
                                    Our mission ensures that no senior or vulnerable individual goes hungry while waiting for support.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Impact / Contributions (Premium Grid) -->
        <section class="py-20 lg:py-32 bg-dark">
            <div class="container mx-auto px-6">
                <div class="text-center max-w-3xl mx-auto mb-20 space-y-6 animate-on-scroll">
                    <h2 class="text-h2 font-black text-white tracking-tighter">Small Actions, Huge <span class="text-primary italic">Impact</span>.</h2>
                    <p class="text-white/60 text-lg font-medium">Measuring our shared dedication to the community.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Stat 1 -->
                    <div class="group p-10 bg-white/5 border border-white/10 rounded-[2rem] text-center hover:bg-primary transition-all duration-500 animate-on-scroll">
                        <div class="w-20 h-20 bg-primary/20 rounded-2xl mx-auto mb-8 flex items-center justify-center group-hover:bg-dark transition-colors">
                            <svg class="w-10 h-10 text-primary group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-white group-hover:text-dark mb-2">2,000+</h4>
                        <p class="text-white/50 group-hover:text-dark/70 font-bold uppercase tracking-widest text-xs">Meals Delivered</p>
                    </div>

                    <!-- Stat 2 -->
                    <div class="group p-10 bg-white/5 border border-white/10 rounded-[2rem] text-center hover:bg-primary transition-all duration-500 animate-on-scroll" style="transition-delay: 100ms">
                        <div class="w-20 h-20 bg-primary/20 rounded-2xl mx-auto mb-8 flex items-center justify-center group-hover:bg-dark transition-colors">
                            <svg class="w-10 h-10 text-primary group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-white group-hover:text-dark mb-2">527</h4>
                        <p class="text-white/50 group-hover:text-dark/70 font-bold uppercase tracking-widest text-xs">Individuals Served</p>
                    </div>

                    <!-- Stat 3 -->
                    <div class="group p-10 bg-white/5 border border-white/10 rounded-[2rem] text-center hover:bg-primary transition-all duration-500 animate-on-scroll" style="transition-delay: 200ms">
                        <div class="w-20 h-20 bg-primary/20 rounded-2xl mx-auto mb-8 flex items-center justify-center group-hover:bg-dark transition-colors">
                            <svg class="w-10 h-10 text-primary group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-white group-hover:text-dark mb-2">31</h4>
                        <p class="text-white/50 group-hover:text-dark/70 font-bold uppercase tracking-widest text-xs">Major Partners</p>
                    </div>

                    <!-- Stat 4 -->
                    <div class="group p-10 bg-white/5 border border-white/10 rounded-[2rem] text-center hover:bg-primary transition-all duration-500 animate-on-scroll" style="transition-delay: 300ms">
                        <div class="w-20 h-20 bg-primary/20 rounded-2xl mx-auto mb-8 flex items-center justify-center group-hover:bg-dark transition-colors">
                            <svg class="w-10 h-10 text-primary group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-white group-hover:text-dark mb-2">73%</h4>
                        <p class="text-white/50 group-hover:text-dark/70 font-bold uppercase tracking-widest text-xs">Senior Outreach</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Call to Action (Airy Footer) -->
        <section class="py-24 lg:py-40 relative">
            <div class="container mx-auto px-6 text-center space-y-12 animate-on-scroll">
                <div class="space-y-4">
                    <h2 class="text-h1 font-black text-dark tracking-tighter leading-none">Ready to write the <span class="italic text-primary underline decoration-dark/10">Next Chapter</span>?</h2>
                    <p class="text-xl text-foreground/60 font-medium max-w-2xl mx-auto">Your support can turn a vision into a reality for someone in need today.</p>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="{{ route('donation') }}" class="w-full sm:w-auto px-12 py-5 bg-primary text-dark font-black rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">Donate Now</a>
                    <a href="{{ route('contact') }}" class="w-full sm:w-auto px-12 py-5 bg-white border-2 border-dark/5 text-dark font-black rounded-2xl hover:bg-dark hover:text-white transition-all">Become a Partner</a>
                </div>
            </div>
        </section>

    </div>
    @section('js_custom')
        @vite(['resources/js/docs-animations.js'])
    @endsection
</x-app-layout>
