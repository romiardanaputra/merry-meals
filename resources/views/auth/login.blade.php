<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="flex min-h-screen flex-col items-center justify-center px-4 py-6">
    <div class="grid w-full max-w-6xl items-center gap-10 max-md:max-w-md md:grid-cols-2">
      <div>
        <div class="flex items-center gap-4 lg:pb-10">
          <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="logo" class="size-2/12 lg:size-2/12" />
          <div class="flex flex-col">
            <span class="text-lg font-bold uppercase tracking-wider">Merry Meals</span>
            <span class="text-sm font-bold uppercase tracking-widest">Meals On Wheel</span>
          </div>
        </div>

        <h2 class="dark:text-light text-3xl font-bold text-accentSecondary lg:text-5xl lg:leading-[57px]">
          Seamless Login for Exclusive Access
        </h2>
        <p class="dark:text-light mt-6 text-sm font-medium leading-relaxed text-dark md:text-base lg:text-lg">
          Immerse yourself in a hassle-free login journey with our intuitively designed login form. Effortlessly access
          your account.
        </p>
        <p class="dark:text-light mt-12 text-sm font-medium text-dark">
          Don't have an account
          <a href="{{ route('register') }}" class="ml-1 font-medium text-accent hover:underline">Register here</a>
        </p>
      </div>

      <form class="w-full max-w-md md:ml-auto" method="POST">
        @csrf
        <h3 class="dark:text-light mb-8 text-2xl font-bold text-accentSecondary lg:text-3xl">Sign in</h3>

        <div class="space-y-6">
          <div>
            <label class="dark:text-light mb-2 block text-sm font-medium text-slate-800">Email</label>
            <input
              name="email"
              type="email"
              required
              class="w-full rounded-md border border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-0 focus:border-primary focus:bg-transparent"
              placeholder="Enter Email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
          <div>
            <label class="mb-2 block text-sm font-medium text-slate-800">Password</label>
            <input
              name="password"
              type="password"
              required
              class="w-full rounded-md border border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-0 focus:border-primary focus:bg-transparent"
              placeholder="Enter Password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
          <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center">
              <input
                id="remember_me"
                name="remember"
                type="checkbox"
                class="h-4 w-4 rounded border-slate-300 text-green-50 focus:ring-primary"
              />
              <label for="remember_me" class="ml-3 block text-sm text-slate-500">Remember me</label>
            </div>
            <div class="text-sm">
              <a href="{{ route('password.request') }}" class="font-medium text-accent hover:text-primary">
                Forgot your password?
              </a>
            </div>
          </div>
        </div>

        <div class="!mt-12">
          <button
            type="button"
            class="w-full cursor-pointer rounded bg-accentSecondary px-4 py-2.5 text-sm font-semibold text-white shadow-xl hover:bg-accent focus:outline-none"
          >
            Log in
          </button>
        </div>

        <div class="my-4 flex items-center gap-4">
          <hr class="w-full border-slate-300" />
          <p class="text-center text-sm text-slate-800">or</p>
          <hr class="w-full border-slate-300" />
        </div>
        <button
          type="button"
          class="w-full cursor-pointer rounded bg-orange-400 px-4 py-2.5 text-sm font-semibold text-white shadow-xl hover:bg-accent focus:outline-none"
        >
          Sign in with Google
        </button>
      </form>
    </div>
  </div>
</x-guest-layout>
