@section('js_custom')
  <script defer async type="module">
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
      if (collapseMenu.style.display === 'block') {
        collapseMenu.style.display = 'none';
      } else {
        collapseMenu.style.display = 'block';
      }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);
  </script>
@endsection

<header class="bg-light">
  <div
    class="relative z-50 mx-auto flex min-h-[70px] w-full max-w-screen-2xl flex-wrap items-center justify-between gap-5 px-4 py-4 tracking-wide sm:px-10"
  >
    <a href="{{ route('index') }}" class="flex items-center gap-4 max-sm:hidden">
      <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="logo" class="w-9" />
      <div class="flex flex-col">
        <span class="text-lg font-bold uppercase tracking-wider">Merry Meals</span>
        <span class="text-sm font-bold uppercase tracking-widest">Meals On Wheel</span>
      </div>
    </a>
    <a href="{{ route('index') }}" class="hidden max-sm:block">
      <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="logo" class="w-9" />
    </a>

    <div
      id="collapseMenu"
      class="max-lg:hidden max-lg:before:fixed max-lg:before:inset-0 max-lg:before:z-50 max-lg:before:bg-black max-lg:before:opacity-50 lg:!block"
    >
      <button
        id="toggleClose"
        class="fixed right-4 top-2 z-[100] flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-gray-200 bg-white lg:hidden"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 fill-black" viewBox="0 0 320.591 320.591">
          <path
            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
            data-original="#000000"
          ></path>
          <path
            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
            data-original="#000000"
          ></path>
        </svg>
      </button>

      <ul
        class="z-50 gap-x-4 max-lg:fixed max-lg:left-0 max-lg:top-0 max-lg:h-full max-lg:w-1/2 max-lg:min-w-[300px] max-lg:space-y-3 max-lg:overflow-auto max-lg:bg-white max-lg:p-6 max-lg:shadow-md lg:flex"
      >
        <li class="mb-6 hidden max-md:block sm:flex sm:items-center sm:gap-4 lg:hidden">
          <a href="{{ route('index') }}">
            <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="logo" class="w-36" />
          </a>
          <div class="flex flex-col text-dark">
            <span class="text-lg font-bold tracking-wider">Merry Meals</span>
            <span class="text-sm font-medium tracking-widest">Meals On Wheel</span>
          </div>
        </li>
        <x-nav-link :active="request()->routeIs('index')" :route="route('index')">Home</x-nav-link>
        <x-nav-link :active="request()->routeIs('about')" :route="route('about')">About</x-nav-link>
        <x-nav-link :active="request()->routeIs('contact')" :route="route('contact')">Contact</x-nav-link>
        <x-nav-link :active="request()->routeIs('donation')" :route="route('donation')">Donation</x-nav-link>
      </ul>
    </div>

    <div class="flex space-x-4 max-lg:ml-auto">
      <x-button :type="App\Enum\ButtonType::SolidHover" :route="route('login')" :classes="'bg-primary'">
        Login
      </x-button>
      <x-button
        :type="App\Enum\ButtonType::OutlineHover"
        :route="route('register')"
        :classes="'border-dark hover:bg-dark !text-dark hover:!text-light'"
      >
        Join Now
      </x-button>

      <button id="toggleOpen" class="cursor-pointer lg:hidden">
        <svg class="h-7 w-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path
            fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
    </div>
  </div>
</header>
