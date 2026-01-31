<x-app-layout>
  <div class="bg-gray-100 px-4 py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <h2 class="mb-10 text-center text-2xl font-bold text-slate-900 sm:text-left sm:text-3xl">Latest Blog Posts</h2>

      <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ([
            ['src' => 'https://readymadeui.com/cardImg.webp', 'title' => 'Lorem Ipsum Dolor'],
            ['src' => 'https://readymadeui.com/hotel-img.webp', 'title' => 'Consectetur Adipiscing'],
            ['src' => 'https://readymadeui.com/team-image.webp', 'title' => 'Lorem Ipsum Sit Amet'],
            ['src' => 'https://readymadeui.com/prediction.webp', 'title' => 'Prediction Insights'],
            ['src' => 'https://readymadeui.com/hacks-watch.webp', 'title' => 'Tech Hacks to Watch'],
            ['src' => 'https://readymadeui.com/Imagination.webp', 'title' => 'Imagination Unleashed']
          ]
          as $post)
          <div class="overflow-hidden rounded-lg bg-white shadow-sm">
            <img src="{{ $post['src'] }}" alt="{{ $post['title'] }}" class="h-52 w-full object-cover" />
            <div class="p-5">
              <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $post['title'] }}</h3>
              <p class="text-sm leading-relaxed text-slate-600">
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore...
              </p>
              <p class="mt-2 text-xs font-semibold text-orange-500">08 April 2024</p>
              <a
                href="javascript:void(0);"
                class="mt-4 inline-block rounded-sm bg-orange-500 px-4 py-2 text-xs font-medium text-white transition hover:bg-orange-600"
              >
                Read More
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>
