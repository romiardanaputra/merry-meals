<x-app-layout>
    @section('css_custom')
        @vite(['resources/css/docs.css'])
        <style>
            .text-h1 { font-size: 3.815rem; font-weight: 900; line-height: 1.05; letter-spacing: -0.05em; }
            .text-h2 { font-size: 3.052rem; font-weight: 900; line-height: 1.1; }
            .text-h3 { font-size: 2.441rem; font-weight: 900; line-height: 1.1; }
            .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
            .text-h5 { font-size: 1.5625rem; font-weight: 800; }
            .text-h6 { font-size: 1.25rem; font-weight: 800; }
            .text-p  { font-size: 1rem; font-weight: 500; line-height: 1.6; color: #222222; }
            .font-black { font-weight: 900; }
            
            @keyframes pulse-slow {
                0%, 100% { opacity: 0.3; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(1.05); }
            }
            .animate-pulse-slow {
                animation: pulse-slow 8s infinite ease-in-out;
            }
        </style>
    @endsection

    <div class="bg-background-soft font-inter min-h-screen overflow-x-hidden">
        
        <!-- Hero Section (Social Proof) -->
        <section class="relative h-[80vh] min-h-[600px] flex items-center overflow-hidden">
            <!-- Background Image with Warming Overlay -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/95 to-transparent z-10 backdrop-blur-[2px]"></div>
                <!-- Note: image_bdef14.jpg would go here if file exists, using placeholder for now -->
                <img src="{{ asset('storage/images/donateBackground2.jpg') }}" 
                     alt="Empowering Lives" 
                     class="w-full h-full object-cover grayscale-[20%] sepia-[10%] contrast-[110%]"
                     loading="eager" />
            </div>

            <div class="container mx-auto px-6 relative z-20">
                <div class="max-w-3xl space-y-8 animate-on-scroll">
                    <div class="space-y-4">
                        <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary text-xs font-black uppercase tracking-[0.4em] rounded-full backdrop-blur-md border border-primary/20">Charity & Impact</span>
                        <h1 class="text-h1 text-white">
                            A Single Step,<br/>
                            <span class="italic text-primary">A Plate of Hope.</span>
                        </h1>
                    </div>
                    <p class="text-xl text-white/90 font-medium leading-relaxed max-w-xl">
                        Your contribution helps seniors and persons with disabilities access the nutrition they need for a healthier, more dignified life.
                    </p>
                    <div class="flex flex-wrap items-center gap-6 pt-4">
                        <div class="flex -space-x-3">
                            <img src="https://i.pravatar.cc/100?u=1" class="w-12 h-12 rounded-full border-2 border-dark" />
                            <img src="https://i.pravatar.cc/100?u=2" class="w-12 h-12 rounded-full border-2 border-dark" />
                            <img src="https://i.pravatar.cc/100?u=3" class="w-12 h-12 rounded-full border-2 border-dark" />
                            <div class="w-12 h-12 rounded-full border-2 border-dark bg-primary flex items-center justify-center text-xs font-black">+8k</div>
                        </div>
                        <p class="text-sm font-bold text-white/50">Joined by <span class="text-white">8,402 individuals</span> this year</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content (Two Column Layout) -->
        <div class="container mx-auto px-6 -mt-32 relative z-30 pb-32">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
                <!-- Left Column: Form (60%) - Priority on Mobile -->
                <div class="w-full lg:w-7/12 order-1">
                    <div class="space-y-12">
                        @include('features.public.donations.partials.donation-form')
                        
                        <!-- Refined Mission Statement -->
                        <div class="p-10 bg-white rounded-[2.5rem] border border-border/50 animate-on-scroll">
                            <h4 class="text-h4 text-dark mb-6 tracking-tight">Every Contribution Counts</h4>
                            <p class="text-p leading-relaxed">
                                Your contribution to Merry Meals makes a profound difference in the lives of our elders and the homebound. Every dollar counts in our mission to end senior hunger. We deeply appreciate your generosity and partnership. Every day, our dedicated volunteers and drivers reach out to the most vulnerable members of our community, ensuring they receive not only a nutritious meal but also a vital moment of engagement and connection.
                            </p>
                        </div>

                        @include('features.public.donations.partials.trust-indicators')
                    </div>
                </div>

                <!-- Right Column: Visual Storytelling & Stats (40%) -->
                <div class="w-full lg:w-5/12 order-2">
                    <div class="sticky top-12 space-y-12">
                        @include('features.public.donations.partials.impact-stats')
                        
                        <!-- Mini Quote Card -->
                        <div class="p-10 bg-dark rounded-[2.5rem] relative overflow-hidden group">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-all duration-700"></div>
                            <svg class="w-12 h-12 text-primary/30 mb-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3601 2 17.017 2H20.017C21.6738 2 23.017 3.34315 23.017 5V19C23.017 20.1046 22.1216 21 21.017 21H14.017ZM1.017 19V5C1.017 3.34315 2.36011 2 4.017 2H7.017C8.67385 2 10.017 3.34315 10.017 5V6C10.017 7.10457 9.12157 8 8.017 8H5.017C4.46472 8 4.017 8.44772 4.017 9V15C4.017 15.5523 4.46472 16 5.017 16H8.017C9.12157 16 10.017 16.8954 10.017 18V21H1.017Z" />
                            </svg>
                            <p class="text-xl text-white font-medium leading-relaxed italic relative z-10">
                                "Your contribution is more than just money—it’s about restoring dignity to those who need it most."
                            </p>
                            <div class="mt-8 flex items-center gap-4">
                                <div class="w-10 h-1 bg-primary rounded-full"></div>
                                <p class="text-sm font-black uppercase tracking-widest text-white/40">Merry Meals Team</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js_custom')
        @vite(['resources/js/docs-animations.js'])
    @endsection
</x-app-layout>
