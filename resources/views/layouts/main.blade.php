<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO & Meta Tags --}}
    {!! SEO::generate() !!}

    {{-- Resource Hints --}}
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    
    {{-- Fonts --}}
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('css_custom')
    
    {{-- Modern JS loading: defer is handled by @vite by default --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-background-soft text-dark selection:bg-primary selection:text-dark">
    {{-- Skip Navigation for Accessibility --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 z-[100] px-4 py-2 bg-primary text-dark rounded-lg font-bold">
        Skip to content
    </a>

    <div id="main-content">
        @yield('component_content')
    </div>
    
    {{-- Footer is usually included in feature templates, but could be globalized here --}}
    
    @yield('js_custom')
    @stack('scripts')
</body>
</html>
