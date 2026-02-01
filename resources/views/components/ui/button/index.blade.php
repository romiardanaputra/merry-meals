@switch($type)
  @case(App\Enum\ButtonType::RGB)
    <div class="group relative inline-flex">
      <div
        class="transitiona-all absolute -inset-px rounded-xl bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] opacity-70 blur-lg filter duration-1000 group-hover:-inset-1 group-hover:opacity-100 group-hover:duration-200"
      ></div>
      <a
        href="{{ $route }}"
        target="{{ $target }}"
        title="{{ $title }}"
        role="{{ $role }}"
        class="{{ $classes }} relative inline-flex items-center justify-center rounded border-2 border-transparent bg-gray-900 px-5 py-2 text-base font-semibold text-white transition-all duration-200 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2"
      >
        {{ $slot }}
      </a>
    </div>

    @break
  @case(App\Enum\ButtonType::Solid)
    <div>
      <a href="{{ $route }}">
        <button
          type="button"
          class="{{ $classes }} cursor-pointer rounded-lg border border-current bg-blue-700 px-5 py-2.5 text-sm font-medium tracking-wider text-white outline-none hover:bg-blue-800 active:bg-blue-700"
        >
          {{ $slot }}
        </button>
      </a>
    </div>

    @break
  @case(App\Enum\ButtonType::OutlineHover)
    <a href="{{ $route }}">
      <button
        type="button"
        class="{{ $classes }} cursor-pointer rounded-lg border-2 border-blue-700 bg-transparent px-5 py-2.5 text-sm font-semibold tracking-wider text-blue-700 outline-none transition-all duration-300 hover:bg-blue-700 hover:text-white"
      >
        {{ $slot }}
      </button>
    </a>

    @break
  @case(App\Enum\ButtonType::SolidHover)
    <a href="{{ $route }}">
      <button
        type="button"
        class="{{ $classes }} cursor-pointer rounded-lg border-2 border-current bg-dark px-5 py-2.5 text-sm font-medium tracking-wider text-dark outline-none transition-all duration-300 hover:bg-transparent hover:text-dark border-primary"
      >
        {{ $slot }}
      </button>
    </a>

    @break
  @default
    <div>
      <a href="{{ $route }}">
        <button
          type="button"
          class="{{ $classes }} cursor-pointer rounded-lg border-2 border-current bg-dark px-5 py-2.5 text-sm font-medium tracking-wider text-white outline-none transition-all duration-300 hover:bg-transparent hover:text-orange-700"
        >
          {{ $slot }}
        </button>
      </a>
    </div>
@endswitch
