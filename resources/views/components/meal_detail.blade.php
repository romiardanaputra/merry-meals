@extends('layout.main')
@section('component_content')
<main class="bg-[#FFFCF0] font-poppins">
    @include('components.navbar')

<div class="flex justify-center m-auto my-[70px] text-justify leading-relaxed space-x-[50px]">
    <div class="overflow-y-auto w-[563px] h-[316px]">
        <h1 class="text-[32px] text-[#282222] font-bold">{{ $meal->name }}</h1>
        <p class="text-[24px] text-[#282222] mt-[20px]">
            {{ $meal->ingredient }}
        </p>
    </div>

    <div class="flex flex-col space-y-[50px]">
        <img class="w-[562px] h-[316px]" src="{{ asset('storage/'. $meal->path) }}" alt="image-meal-detail">

        <div class="flex flex-row justify-between">
            <a href="{{ route('user.dashboard') }}">
                <button class="bg-[#FFFCF0] border-2 border-[#A07C00] text-[16px] text-[#A07C00] h-[64px] w-[271px] hover:scale-105 duration-500">
                BACK
                </button>
            </a> 

            <a href="">
                <button class="bg-[#A07C00] border-2 border-[#A07C00] text-[16px] text-[#FFFCF0] h-[64px] w-[271px] hover:scale-105 duration-500">
                SELECT
                </button>
            </a> 
        </div>
    </div>

</div>   

   

    @include('components.footer')
</main>
@endsection