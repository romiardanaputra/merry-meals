<form method="POST" action="{{ route('login') }}" class="space-y-8">
    @csrf

    <!-- Email Address -->
    <div class="space-y-1.5">
        <label for="email" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Email Address</label>
        <div class="relative group">
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                placeholder="name@company.com" />
        </div>
        <x-form.input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
    </div>

    <!-- Password -->
    <div class="space-y-1.5">
        <div class="flex items-center justify-between px-1">
            <label for="password" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40">Password</label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-bold text-primary hover:underline transition-all">Forgot?</a>
            @endif
        </div>
        <div class="relative group">
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                placeholder="••••••••" />
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
    </div>

    <!-- Remember Me -->
    <div class="flex items-center gap-3 px-1">
        <input id="remember_me" type="checkbox" name="remember" 
            class="w-5 h-5 rounded-lg border-border/40 text-primary focus:ring-primary/20 transition-all cursor-pointer">
        <label for="remember_me" class="text-sm font-semibold text-dark/40 cursor-pointer select-none">Remember this device</label>
    </div>

    <!-- CTA -->
    <div class="pt-4 space-y-6">
        <button type="submit" class="w-full py-5 bg-dark text-white text-h6 font-black rounded-2xl shadow-xl hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3 group">
            Login Now
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>

        <div class="relative py-2 flex items-center gap-4">
            <div class="flex-1 h-px bg-border/20"></div>
            <span class="text-xs font-black uppercase tracking-widest text-dark/20">or</span>
            <div class="flex-1 h-px bg-border/20"></div>
        </div>

        <p class="text-center text-sm font-medium text-dark/40">
            Secure connection enabled.
        </p>
    </div>
</form>
