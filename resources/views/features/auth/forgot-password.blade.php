<x-guest-layout>
    @section('css_custom')
        <style>
            .text-h2 { font-size: 3.052rem; font-weight: 900; line-height: 1.1; letter-spacing: -0.04em; }
            .text-h6 { font-size: 1.25rem; font-weight: 800; }
        </style>
    @endsection

    <div class="min-h-screen bg-background-soft font-inter selection:bg-primary/30 flex items-center justify-center p-6">
        <div class="w-full max-w-md space-y-12">
            
            <!-- Header -->
            <div class="text-center space-y-4 animate-on-scroll">
                <div class="flex flex-col items-center gap-4">
                    <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" class="h-16 w-auto" />
                    <span class="text-xs font-black uppercase tracking-[0.4em] text-dark/40">Secure Recovery</span>
                </div>
                <div class="space-y-2">
                    <h2 class="text-h2 text-dark tracking-tighter">Forgot Password?</h2>
                    <p class="text-dark/40 font-medium italic px-4">No worries, we'll send you reset instructions.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white p-8 lg:p-10 rounded-[2.5rem] shadow-2xl shadow-dark/5 border border-border/40 animate-on-scroll">
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Registered Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                            placeholder="name@company.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
                    </div>

                    <!-- CTA -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-5 bg-dark text-white text-h6 font-black rounded-2xl shadow-xl hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3 group">
                            Email Reset Link
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer Link -->
            <p class="text-center text-dark/40 font-medium">
                Remember your password? 
                <a href="{{ route('login') }}" class="text-primary font-black hover:underline ml-1">Back to Login</a>
            </p>
        </div>
    </div>
</x-guest-layout>
