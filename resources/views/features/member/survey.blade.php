@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter p-4 sm:p-8 lg:p-12 overflow-x-hidden">
    <!-- Header (Consistent with Member Suite) -->
    <header class="max-w-[1200px] mx-auto flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-16 px-2">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm p-2">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-xl font-black tracking-tight text-dark uppercase leading-none">Service Feedback</h1>
                <p class="text-[9px] font-bold text-primary tracking-widest uppercase mt-1">Help us improve</p>
            </div>
        </div>

        <nav x-data="{ 
                activeIndex: 2,
                get sliderStyle() {
                    const el = this.$refs['navItem' + this.activeIndex];
                    if (!el) return '';
                    return `left: ${el.offsetLeft}px; width: ${el.offsetWidth}px;`;
                }
             }" 
             class="hidden lg:flex items-center bg-white p-1.5 rounded-full shadow-sm border border-black/5 relative overflow-hidden h-12">
            
            <div class="absolute top-1.5 bottom-1.5 bg-dark rounded-full shadow-lg shadow-dark/20 transition-all duration-500 ease-out z-0" 
                 :style="sliderStyle"></div>
            
            <div class="flex items-center space-x-1 min-w-max px-1">
                @php
                    $navLinks = [
                        ['route' => 'member.dashboard', 'label' => 'Overview', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'meal.menu', 'label' => 'Browse Menu', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['route' => 'member.survey', 'label' => 'Feedback', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ];
                @endphp

                @foreach($navLinks as $index => $link)
                    <a href="{{ route($link['route']) }}" 
                       x-ref="navItem{{ $index }}"
                       class="flex items-center space-x-2 px-6 py-2 rounded-full font-black text-[11px] uppercase tracking-wider transition-all duration-500 whitespace-nowrap relative z-10 
                       {{ Request::routeIs($link['route']) ? 'text-white' : 'text-dark/40 hover:text-dark' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $link['icon'] }}" /></svg>
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </nav>
    </header>

    <div class="max-w-[800px] mx-auto">
        <div class="mb-16 text-center">
            <h1 class="text-h2 text-dark tracking-tighter">Tell Us Your Thoughts</h1>
            <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2 italic">Your experience drives our mission</p>
        </div>

        <form action="{{ route('member.survey.store') }}" method="POST" class="space-y-8" x-data="{ currentStep: 1, totalSteps: 8 }">
            @csrf
            
            <!-- Survey Cards Container -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-16 border border-black/5 shadow-2xl shadow-dark/5 relative overflow-hidden">
                <!-- Progress Line -->
                <div class="absolute top-0 left-0 right-0 h-2 bg-dark/5">
                    <div class="h-full bg-primary transition-all duration-700" :style="`width: ${(currentStep / totalSteps) * 100}%` text-p"></div>
                </div>

                <!-- Questions -->
                <div class="space-y-12 py-6">
                    @php
                        $questions = [
                            'How satisfied are you with the freshness of our meals?',
                            'How would you rate the variety of food options available?',
                            'Was your order delivered on time?',
                            'How was the quality of the meal packaging?',
                            'How easy was it to navigate the member dashboard?',
                            'Would you recommend Merry Meals to others?',
                            'How satisfied are you with the nutritional information provided?',
                            'Do you have any other suggestions for us?'
                        ];
                    @endphp

                    @foreach($questions as $i => $q)
                    <div x-show="currentStep == {{ $i + 1 }}" 
                         x-transition:enter="transition ease-out duration-500 delay-200"
                         x-transition:enter-start="translate-x-12 opacity-0"
                         x-transition:enter-end="translate-x-0 opacity-100"
                         class="space-y-8">
                        <div>
                            <span class="text-[10px] font-black text-primary uppercase tracking-[0.4em] mb-4 block animate-pulse italic">Question 0{{ $i + 1 }}</span>
                            <h3 class="text-3xl font-black text-dark tracking-tighter leading-tight">{{ $q }}</h3>
                        </div>

                        <div class="space-y-4">
                            @if($i < 7) <!-- Multi-choice for first 7 questions -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach(['Highly Satisfied', 'Satisfied', 'Neutral', 'Dissatisfied'] as $option)
                                <label class="relative flex items-center p-6 bg-dark/5 rounded-2xl cursor-pointer hover:bg-dark group transition-all">
                                    <input type="radio" name="q{{ $i + 1 }}" value="{{ $option }}" required class="sr-only peer">
                                    <div class="w-5 h-5 border-2 border-dark/20 rounded-full flex items-center justify-center mr-4 peer-checked:border-primary group-hover:border-white/20">
                                        <div class="w-2.5 h-2.5 bg-primary rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                                    </div>
                                    <span class="text-sm font-bold text-dark group-hover:text-white transition-colors">{{ $option }}</span>
                                </label>
                                @endforeach
                            </div>
                            @else <!-- Text area for the last question -->
                            <textarea name="q{{ $i + 1 }}" required rows="5" 
                                      class="w-full p-8 bg-dark/5 border-none rounded-[2rem] text-dark placeholder:text-dark/20 focus:ring-2 focus:ring-primary/20 transition-all font-medium"
                                      placeholder="Your message here..."></textarea>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <!-- Overall Rating (Final View) -->
                    <div x-show="currentStep == 9" 
                         x-transition:enter="transition ease-out duration-500 delay-200"
                         x-transition:enter-start="scale-95 opacity-0"
                         x-transition:enter-end="scale-100 opacity-100"
                         class="text-center space-y-10">
                        <div class="space-y-2">
                            <h3 class="text-4xl font-black text-dark tracking-tighter">One last thing...</h3>
                            <p class="text-dark/40 font-bold text-xs uppercase tracking-widest">Your overall rating for Merry Meals</p>
                        </div>

                        <div class="flex items-center justify-center space-x-4">
                            @for($i=1; $i<=5; $i++)
                            <label class="cursor-pointer group">
                                <input type="radio" name="overall" value="{{ $i }}" required class="sr-only peer">
                                <div class="w-16 h-16 bg-dark/5 rounded-2xl flex items-center justify-center text-dark/20 peer-checked:bg-primary peer-checked:text-dark hover:scale-110 transition-all shadow-sm peer-checked:shadow-xl peer-checked:shadow-primary/20">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                </div>
                            </label>
                            @endfor
                        </div>

                        <button type="submit" class="w-full py-8 bg-dark text-white rounded-[2rem] font-black text-base uppercase tracking-[0.3em] shadow-2xl shadow-dark/20 hover:bg-primary hover:text-dark hover:scale-[1.02] active:scale-95 transition-all">
                            Submit My Feedback
                        </button>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-16 flex items-center justify-between" x-show="currentStep < 9">
                    <button type="button" 
                            @click="currentStep--" 
                            x-show="currentStep > 1"
                            class="px-8 py-4 bg-dark/5 text-dark font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-dark hover:text-white transition-all">
                        Previous
                    </button>
                    <div x-show="currentStep == 1"></div> <!-- Spacer -->
                    
                    <button type="button" 
                            @click="currentStep++"
                            class="px-10 py-5 bg-dark text-white rounded-[1.5rem] font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10 hover:scale-105 transition-all">
                        <span x-text="currentStep == 8 ? 'Almost Done!' : 'Next Question'"></span>
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-12 text-center">
            <a href="{{ route('member.dashboard') }}" class="text-[10px] font-black text-dark/20 uppercase tracking-widest hover:text-dark transition-colors italic">Skip for now</a>
        </div>
    </div>
</main>
@endsection
