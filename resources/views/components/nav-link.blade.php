@php
  $classes = $active ? 'text-accent' : '';
@endphp

<li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
  <a href="{{ $route }}" class="{{ $classes }} block text-[15px] font-medium text-dark hover:text-accent">
    {{ $slot }}
  </a>
</li>
