<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Name -->
        <div class="space-y-1.5">
            <label for="name" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Full Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                placeholder="John Doe" />
            <x-form.input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <!-- Username -->
        <div class="space-y-1.5">
            <label for="username" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Username</label>
            <input id="username" type="text" name="username" :value="old('username')" required autocomplete="username"
                class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                placeholder="johndoe123" />
            <x-form.input-error :messages="$errors->get('username')" class="mt-2 text-xs font-bold text-red-500" />
        </div>
    </div>

    <!-- Email Address -->
    <div class="space-y-1.5">
        <label for="email" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Email Address</label>
        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
            class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
            placeholder="name@company.com" />
        <x-form.input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
    </div>

    <!-- Phone -->
    <div class="space-y-1.5">
        <label for="phone" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Mobile Number</label>
        <input id="phone" type="text" name="phone" :value="old('phone')" required autocomplete="tel"
            class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
            placeholder="+62 812 3456 7890" />
        <x-form.input-error :messages="$errors->get('phone')" class="mt-2 text-xs font-bold text-red-500" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Password -->
        <div class="space-y-1.5">
            <label for="password" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                placeholder="••••••••" />
            <x-form.input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <label for="password_confirmation" class="text-xs font-bold uppercase tracking-[0.2em] text-dark/40 ml-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-6 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/20"
                placeholder="••••••••" />
            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-500" />
        </div>
    </div>

    <!-- CTA -->
    <div class="pt-6">
        <button type="submit" class="w-full py-5 bg-dark text-white text-h6 font-black rounded-2xl shadow-xl hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3 group">
            Create Account
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </div>
</form>
