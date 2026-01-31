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

    <x-landing.hero />
    <x-landing.stats />
    <x-landing.mission />
    <x-landing.features />
    <x-landing.cta />

    @section('js_custom')
        @vite(['resources/js/docs-animations.js'])
    @endsection
</x-app-layout>
