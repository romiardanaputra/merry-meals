@extends('layouts.dashboard.base')

@section('dashboard_content')
<div class="max-w-[1000px] space-y-12">
    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-black text-dark tracking-tighter">Service Feedback</h1>
        <p class="text-dark/40 font-bold text-xs uppercase tracking-[0.3em] mt-2 italic">Your voice helps us improve the Merry Meals community experience</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-3xl p-8 md:p-12 border border-black/5 shadow-sm">
        <form action="{{ route('member.survey.store') }}" method="POST" class="space-y-16">
            @csrf
            
            @php
                $questions = [
                    'q1' => 'How would you rate the freshness of the meal items delivered today?',
                    'q2' => 'Was the delivery completed within the expected time window?',
                    'q3' => 'How satisfied are you with the nutritional balance of our menus?',
                    'q4' => 'Did the meal arrive at the appropriate temperature?',
                    'q5' => 'Was the delivery personnel professional and courteous?',
                    'q6' => 'How would you rate the ease of use of our ordering platform?',
                    'q7' => 'Are you satisfied with the portion sizes provided in our packages?',
                    'q8' => 'Would you recommend Merry Meals to other members in need?',
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16">
                @foreach($questions as $key => $question)
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <span class="w-8 h-8 rounded-lg bg-dark text-white flex items-center justify-center text-[10px] font-black shrink-0">
                            {{ substr($key, 1) }}
                        </span>
                        <h4 class="text-sm font-bold text-dark/80 leading-relaxed">{{ $question }}</h4>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Poor', 'Fair', 'Good', 'Excellent'] as $option)
                        <label class="relative flex-1 min-w-[100px]">
                            <input type="radio" name="{{ $key }}" value="{{ $option }}" required class="peer sr-only">
                            <div class="px-4 py-3 bg-[#F8F8F8] border border-black/5 rounded-xl text-[10px] font-black uppercase tracking-widest text-center cursor-pointer transition-all peer-checked:bg-primary peer-checked:text-dark peer-checked:border-transparent hover:bg-dark/5">
                                {{ $option }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pt-12 border-t border-black/5">
                <div class="max-w-[400px] space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-widest text-dark/40">Overall Satisfaction Rating</label>
                    <div class="flex items-center space-x-4">
                         @for($i = 1; $i <= 5; $i++)
                             <label class="relative">
                                <input type="radio" name="overall" value="{{ $i }}" required class="peer sr-only">
                                <div class="w-12 h-12 bg-[#F8F8F8] border border-black/5 rounded-2xl flex items-center justify-center text-sm font-black cursor-pointer transition-all peer-checked:bg-dark peer-checked:text-white hover:scale-110">
                                    {{ $i }}
                                </div>
                             </label>
                         @endfor
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('member.dashboard') }}" class="px-10 py-5 bg-white border border-black/10 text-dark rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-dark hover:text-white transition-all text-center">
                    Cancel 
                </a>
                <button type="submit" class="px-12 py-5 bg-primary text-dark rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20">
                    Submit Feedback
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
