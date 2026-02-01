<x-app-layout>
    @section('css_custom')
        @vite(['resources/css/docs.css'])
        <style>
            .text-h2 { font-size: 3.052rem; font-weight: 900; line-height: 1.1; }
            .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
            .font-black { font-weight: 900; }
            
            @keyframes pulse-slow {
                0%, 100% { opacity: 0.3; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(1.05); }
            }
            .animate-pulse-slow {
                animation: pulse-slow 6s infinite ease-in-out;
            }
        </style>
    @endsection

    <div class="bg-background-soft font-inter min-h-screen overflow-x-hidden pt-24 pb-20">
        <div class="container mx-auto px-6">
            <!-- Header Section -->
            <div class="max-w-3xl mb-16 space-y-4 animate-on-scroll">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-black uppercase tracking-[0.2em] rounded-full">Contact Us</span>
                <h1 class="text-h2 text-dark tracking-tighter">
                    Get in <span class="italic text-primary">Touch</span> with Us.
                </h1>
                <p class="text-xl text-foreground/60 font-medium leading-relaxed">
                    Have questions about our programs or want to support our mission? Reach out to the Merry Meals team today.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-16 lg:gap-24">
                <!-- Left Column: Form (60%) -->
                <div class="w-full lg:w-3/5 order-2 lg:order-1">
                    @include('features.public.contact.partials.form')
                </div>

                <!-- Right Column: Info & Map (40%) -->
                <div class="w-full lg:w-2/5 order-1 lg:order-2 space-y-12">
                    @include('features.public.contact.partials.info')
                    @include('features.public.contact.partials.map')
                </div>
            </div>
        </div>
    </div>

    @section('js_custom')
        @vite(['resources/js/docs-animations.js'])
    @endsection
</x-app-layout>
