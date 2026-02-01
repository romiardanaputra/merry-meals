<x-guest-layout>
    @section('css_custom')
        <style>
            .text-h1 { font-size: 3.815rem; font-weight: 900; line-height: 1.05; letter-spacing: -0.05em; }
            .text-h2 { font-size: 3.052rem; font-weight: 900; line-height: 1.1; letter-spacing: -0.04em; }
            .text-h6 { font-size: 1.25rem; font-weight: 800; }
            .font-black { font-weight: 900; }
        </style>
    @endsection

    <div class="min-h-screen bg-background-soft font-inter selection:bg-primary/30">
        <div class="flex flex-col lg:flex-row min-h-screen">
            
            <!-- Visual Hero Side (Hidden on Mobile, Visible on LG+) -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-dark items-center justify-center p-20">
                <div class="absolute inset-0 z-0">
                    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark/80 to-primary/10 z-10"></div>
                    <img src="{{ asset('storage/images/donateBackground2.jpg') }}" 
                         alt="Merry Meals" 
                         class="w-full h-full object-cover opacity-40 grayscale" />
                </div>

                <div class="relative z-20 max-w-xl space-y-12 animate-on-scroll">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="h-12 w-auto" />
                            <div class="h-8 w-px bg-white/20"></div>
                            <span class="text-xs font-black uppercase tracking-[0.4em] text-white/40">Exclusive Portal</span>
                        </div>
                        <h1 class="text-h1 text-white leading-tight">
                            Providing <br/>
                            <span class="text-primary italic">Dignity</span> <br/>
                            in every plate.
                        </h1>
                    </div>
                    
                    <div class="space-y-6">
                        <p class="text-xl text-white/50 font-medium leading-relaxed">
                            Join our community of volunteers and donors dedicated to ending senior hunger. One meal at a time.
                        </p>
                        <div class="flex items-center gap-6 pt-4">
                            <div class="flex -space-x-3">
                                <img src="https://i.pravatar.cc/100?u=4" class="w-10 h-10 rounded-full border-2 border-dark" />
                                <img src="https://i.pravatar.cc/100?u=5" class="w-10 h-10 rounded-full border-2 border-dark" />
                                <img src="https://i.pravatar.cc/100?u=6" class="w-10 h-10 rounded-full border-2 border-dark" />
                            </div>
                            <p class="text-xs font-bold text-white/30 uppercase tracking-widest">Trusted by 8k+ members</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Form Side -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-20 bg-white lg:bg-background-soft">
                <div class="w-full max-w-md space-y-12">
                    
                    <!-- Mobile Header (Visible on Mobile Only) -->
                    <div class="lg:hidden flex flex-col items-center text-center space-y-4 mb-12">
                        <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="h-16 w-auto" />
                        <div class="space-y-2">
                            <h2 class="text-h2 text-dark tracking-tighter">Welcome Back</h2>
                            <p class="text-dark/40 font-medium italic">Please enter your details to continue</p>
                        </div>
                    </div>

                    <!-- Desktop Header (Visible on Desktop) -->
                    <div class="hidden lg:block space-y-4">
                        <h2 class="text-h2 text-dark tracking-tighter">Welcome Back</h2>
                        <p class="text-xl text-dark/40 font-medium">Please enter your details to continue</p>
                    </div>

                    <!-- Main Login Card/Form Content -->
                    <div class="bg-white lg:p-10 lg:rounded-[2.5rem] lg:shadow-2xl lg:shadow-dark/5 lg:border lg:border-border/40 animate-on-scroll">
                        @include('features.auth.partials.login-form')
                    </div>

                    <!-- Footer Link -->
                    <p class="text-center text-dark/40 font-medium">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary font-black hover:underline ml-1">Join Now</a>
                    </p>

                    <!-- Trust Badge -->
                    <div class="flex items-center justify-center gap-8 pt-8 opacity-20 grayscale">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4 w-auto" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" class="h-4 w-auto" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-4 w-auto" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
