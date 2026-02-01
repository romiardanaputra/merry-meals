<x-app-layout>
    @section('css_custom')
        @vite(['resources/css/docs.css'])
        <style>
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .animate-bounce-slow {
                animation: bounce-slow 3s infinite ease-in-out;
            }
        </style>
    @endsection

    @include('features.public.home.partials.hero')
    @include('features.public.home.partials.stats')
    @include('features.public.home.partials.mission')
    @include('features.public.home.partials.features')
    @include('features.public.home.partials.cta')

    @section('js_custom')
        @vite(['resources/js/docs-animations.js'])
    @endsection
</x-app-layout>
