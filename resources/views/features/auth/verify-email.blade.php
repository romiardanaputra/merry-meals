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
                    <span class="text-xs font-black uppercase tracking-[0.4em] text-dark/40">Email Verification</span>
                </div>
                <div class="space-y-2">
                    <h2 class="text-h2 text-dark tracking-tighter">Verify Email</h2>
                    <p class="text-dark/40 font-medium italic px-4">Thanks for signing up! Please verify your email address by clicking the link we just emailed to you.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white p-8 lg:p-10 rounded-[2.5rem] shadow-2xl shadow-dark/5 border border-border/40 animate-on-scroll">
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 p-4 bg-primary/10 border border-primary/20 rounded-2xl text-sm font-bold text-primary text-center">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="flex flex-col gap-6">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full py-5 bg-dark text-white text-h6 font-black rounded-2xl shadow-xl hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3 group">
                            Resend Email
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-dark/40 hover:text-primary transition-all underline underline-offset-4 decoration-border/40 hover:decoration-primary">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
