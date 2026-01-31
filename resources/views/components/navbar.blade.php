@section('js_custom')
  <script defer async type="module">
    const header = document.querySelector('header');
    const toggleOpen = document.getElementById('toggleOpen');
    const toggleClose = document.getElementById('toggleClose');
    const collapseMenu = document.getElementById('collapseMenu');

    // Scroll effect
    window.addEventListener('scroll', () => {
      if (window.scrollY > 10) {
        header.classList.add('header-scrolled');
      } else {
        header.classList.remove('header-scrolled');
      }
    });

    function handleClick() {
      collapseMenu.classList.toggle('hidden');
      collapseMenu.classList.toggle('flex');
    }

    toggleOpen.addEventListener('click', handleClick);
    if(toggleClose) toggleClose.addEventListener('click', handleClick);
  </script>
@endsection

<header class="header-sticky w-full bg-white transition-all duration-300 font-inter">
  <div class="container mx-auto flex h-20 items-center justify-between px-6 lg:px-10">
    <!-- Logo -->
    <a href="{{ route('index') }}" class="flex items-center gap-3 group">
      <div class="relative">
        <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="logo" class="w-10 group-hover:scale-110 transition-transform duration-300" />
        <div class="absolute inset-0 bg-primary/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
      </div>
      <div class="flex flex-col leading-none">
        <span class="text-xl font-black uppercase tracking-tighter text-foreground">Merry Meals</span>
        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-primary">Meals On Wheel</span>
      </div>
    </a>

    <!-- Desktop Navigation -->
    <nav id="collapseMenu" class="hidden lg:flex items-center absolute lg:relative top-full lg:top-auto left-0 w-full lg:w-auto bg-white lg:bg-transparent border-b lg:border-none border-border/10 p-6 lg:p-0 z-50">
      <ul class="flex flex-col lg:flex-row gap-8 lg:gap-10 w-full lg:w-auto">
        <x-nav-link :active="request()->routeIs('index')" :route="route('index')" class="text-sm font-semibold tracking-tight hover:text-primary transition-colors">Home</x-nav-link>
        <x-nav-link :active="request()->routeIs('about')" :route="route('about')" class="text-sm font-semibold tracking-tight hover:text-primary transition-colors">About</x-nav-link>
        <x-nav-link :active="request()->routeIs('contact')" :route="route('contact')" class="text-sm font-semibold tracking-tight hover:text-primary transition-colors">Contact</x-nav-link>
        <x-nav-link :active="request()->routeIs('donation')" :route="route('donation')" class="text-sm font-semibold tracking-tight hover:text-primary transition-colors">Donation</x-nav-link>
      </ul>
    </nav>

    <!-- Actions -->
    <div class="flex items-center gap-4">
      <div class="hidden sm:flex items-center gap-3">
        <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-foreground hover:text-primary transition-colors">Login</a>
        <a href="{{ route('register') }}" class="px-7 py-2.5 bg-primary text-dark font-black text-sm rounded-2xl shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">Join Now</a>
      </div>

      <!-- Mobile Toggle -->
      <button id="toggleOpen" class="p-2 -mr-2 text-foreground lg:hidden">
        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </div>
  </div>
</header>
