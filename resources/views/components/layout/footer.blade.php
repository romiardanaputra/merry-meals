<footer class="bg-dark text-white/90 pt-16 pb-8 font-inter">
    <div class="container mx-auto px-6">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 pb-16 border-b border-white/10">
            
            <!-- Column 1: Brand Identity -->
            <div class="lg:col-span-4 space-y-6">
                <a href="{{ route('index') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Merry Meals Logo" class="w-10 group-hover:scale-110 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-primary/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="text-xl font-black uppercase tracking-tighter text-white">Merry Meals</span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-primary">Meals On Wheels</span>
                    </div>
                </a>
                <p class="text-white/60 text-base leading-relaxed max-w-sm">
                    Nourishing communities through love and timely meals. We support seniors and people with disabilities with fresh, healthy food delivered daily.
                </p>
                <div class="pt-2">
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-primary hover:text-white font-bold transition-colors group">
                        Let's Talk
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Quick Navigation -->
            <div class="lg:col-span-2 space-y-6">
                <h6 class="text-h6 font-black text-white tracking-tight">Navigation</h6>
                <ul class="space-y-4">
                    <li><a href="{{ route('index') }}" class="text-white/60 hover:text-primary transition-colors duration-300">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-white/60 hover:text-primary transition-colors duration-300">Our Mission</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/60 hover:text-primary transition-colors duration-300">Contact Us</a></li>
                    <li><a href="{{ route('donation') }}" class="text-white/60 hover:text-primary transition-colors duration-300">Donations</a></li>
                </ul>
            </div>

            <!-- Column 3: Legal & Support -->
            <div class="lg:col-span-2 space-y-6">
                <h6 class="text-h6 font-black text-white tracking-tight">Legal & Help</h6>
                <ul class="space-y-4">
                    <li><a href="#" class="text-white/60 hover:text-primary transition-colors duration-300">Privacy Policy</a></li>
                    <li><a href="#" class="text-white/60 hover:text-primary transition-colors duration-300">Terms of Use</a></li>
                    <li><a href="#" class="text-white/60 hover:text-primary transition-colors duration-300">Our FAQs</a></li>
                    <li><a href="#" class="text-white/60 hover:text-primary transition-colors duration-300">Volunteer Guide</a></li>
                </ul>
            </div>

            <!-- Column 4: Newsletter & Socials -->
            <div class="lg:col-span-4 space-y-6">
                <h6 class="text-h6 font-black text-white tracking-tight">Stay Connected</h6>
                <p class="text-white/60 text-sm">Subscribe to get updates on our impact.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Email address" class="flex-grow bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all" />
                    <button type="submit" class="p-3 bg-primary text-dark rounded-xl hover:scale-105 active:scale-95 transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
                <div class="flex items-center gap-4 pt-4">
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary hover:text-dark transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary hover:text-dark transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2c2.717 0 3.056.01 4.122.058 1.066.048 1.79.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.637.417 1.36.465 2.427.048 1.066.058 1.405.058 4.122s-.01 3.056-.058 4.122c-.048 1.066-.218 1.79-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.637.247-1.36.417-2.427.465-1.066.048-1.405.058-4.122.058s-3.056-.01-4.122-.058c-1.066-.048-1.79-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.637-.417-1.36-.465-2.427C2.01 15.056 2 14.717 2 12s.01-3.056.058-4.122c.048-1.066.218-1.79.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.523c.637-.247 1.36-.417 2.427-.465C8.944 2.01 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm6.5-.25a1.25 1.25 0 10-2.5 0 1.25 1.25 0 002.5 0zM12 9a3 3 0 110 6 3 3 0 010-6z" />
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary hover:text-dark transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 2a2 2 0 110 4 2 2 0 010-4z" />
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary hover:text-dark transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2C5.12 19.5 12 19.5 12 19.5s6.88 0 8.6-.42a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 2.9 2.9 0 00-.46-5.33zM9.75 15.02V8.48L15.45 11.75l-5.7 3.27z" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-white/40">
            <p>© {{ date('Y') }} Merry Meals. Built with love for the community.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-white transition-colors">Accessibility Statement</a>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
