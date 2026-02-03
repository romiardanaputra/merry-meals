{{--
    Merry Meals Footer Component
    Refactored for responsiveness and performance
--}}
<footer class="bg-dark text-white pt-20 pb-10 mt-auto border-t border-white/5 font-poppins">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 mb-16 items-start">
            
            {{-- Branding Section --}}
            <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-8">
                <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-2xl p-6 flex-shrink-0">
                    <img src="{{ asset('/images/MerryMealLogo-02.png') }}" alt="Merry Meals Logo" class="w-full h-auto object-contain">
                </div>
                <div class="space-y-4">
                    <h1 class="text-3xl md:text-4xl font-black tracking-[0.2em] leading-tight">MERRY MEAL</h1>
                    <h2 class="text-xl md:text-2xl font-bold tracking-[0.1em] text-white/60">MEALS ON WHEELS</h2>
                    <p class="text-sm text-white/40 max-w-md leading-relaxed">Providing nutritious meals and compassionate care to those who need it most. Together, we can make a difference in our community.</p>
                </div>
            </div>

            {{-- Navigation & Registration --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 items-start">
                {{-- Quick Links --}}
                <div class="flex flex-col space-y-4 text-center sm:text-left">
                    <h3 class="text-lg font-bold text-primary border-b border-primary/20 pb-2 mb-2 inline-block sm:table">Company</h3>
                    <a href="{{ route('about') }}" class="text-white/60 hover:text-primary transition-colors duration-300">About Us</a>
                    <a href="{{ route('contact') }}" class="text-white/60 hover:text-primary transition-colors duration-300">Contact Us</a>
                    <a href="{{ route('term') }}" class="text-white/60 hover:text-primary transition-colors duration-300">Terms & Conditions</a>
                </div>

                {{-- Action Section --}}
                @guest
                <div class="flex flex-col space-y-6 text-center sm:text-left">
                    <h3 class="text-lg font-bold">Join Our Mission</h3>
                    <p class="text-sm text-white/60">Sign up today to be a member <br class="hidden lg:block" /> or join our volunteer team.</p>
                    <a href="{{ route('register.index') }}" 
                       class="px-8 py-4 bg-primary text-dark font-black rounded-2xl hover:scale-105 active:scale-95 transition-all text-center uppercase tracking-widest text-xs shadow-lg shadow-primary/20">
                        Register Now
                    </a>
                </div>
                @endguest
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-white/30 font-bold uppercase tracking-widest">&copy; {{ date('Y') }} Merry Meals Project. All Rights Reserved.</p>
            <div class="flex items-center space-x-6">
                {{-- Social Icons could go here --}}
                <span class="text-[10px] text-white/20 font-black uppercase tracking-widest">Designed for Community Impact</span>
            </div>
        </div>
    </div>
</footer>