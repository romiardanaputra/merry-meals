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
            
            <!-- Visual Hero Side -->
            <div class="hidden lg:flex lg:w-5/12 relative overflow-hidden bg-dark items-center justify-center p-20">
                <div class="absolute inset-0 z-0">
                    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark/80 to-primary/10 z-10"></div>
                    <img src="{{ asset('storage/images/donateBackground2.jpg') }}" 
                         alt="Merry Meals Community" 
                         class="w-full h-full object-cover opacity-40 grayscale" />
                </div>

                <div class="relative z-20 max-w-xl space-y-12 animate-on-scroll">
                    @include('features.auth.partials.auth-header', [
                        'title' => 'Start Your Journey.',
                        'subtitle' => 'Join thousands of members dedicated to providing nutrition and dignity to our elders.'
                    ])
                    
                    <div class="space-y-8">
                        <div class="flex items-center gap-6">
                            <div class="flex -space-x-3">
                                <img src="https://i.pravatar.cc/100?u=4" class="w-10 h-10 rounded-full border-2 border-dark" />
                                <img src="https://i.pravatar.cc/100?u=5" class="w-10 h-10 rounded-full border-2 border-dark" />
                                <img src="https://i.pravatar.cc/100?u=6" class="w-10 h-10 rounded-full border-2 border-dark" />
                            </div>
                            <p class="text-xs font-bold text-white/30 uppercase tracking-widest leading-relaxed">
                                Trusted by <span class="text-white">8,400+</span> individuals <br/> across the region.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Register Form Side -->
            <div class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 lg:p-20 bg-white lg:bg-background-soft">
                <div class="w-full max-w-2xl space-y-12">
                    
                    <!-- Mobile Header -->
                    <div class="lg:hidden animate-on-scroll">
                        @include('features.auth.partials.auth-header', [
                            'title' => 'Join Us',
                            'subtitle' => 'Create your account to start making an impact.'
                        ])
                    </div>

                    <!-- Desktop Header -->
                    <div class="hidden lg:block animate-on-scroll">
                        <div class="space-y-2">
                            <h2 class="text-h2 text-dark tracking-tighter">Create Account</h2>
                            <p class="text-xl text-dark/40 font-medium">Be part of the mission today.</p>
                        </div>
                    </div>

                    <!-- Main Form Content -->
                    <div class="bg-white lg:p-12 lg:rounded-[2.5rem] lg:shadow-2xl lg:shadow-dark/5 lg:border lg:border-border/40 animate-on-scroll">
                        @include('features.auth.partials.register-form')
                    </div>

                    <!-- Footer Link -->
                    <p class="text-center lg:text-left text-dark/40 font-medium">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary font-black hover:underline ml-1">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
