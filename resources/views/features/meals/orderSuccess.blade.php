@extends('layout.main')
@section('component_content')
<main class="font-poppins">
    <div class="bg-success-page min-h-screen max-h-fit bg-[#FFFCF0] flex flex-col items-center justify-center space-y-[50px]">
        <div class="order-success-text text-[#282222] text-[48px] font-semibold">
            <p class="text-center text-[100px]"><i class="fa-solid fa-circle-check text-[#8CC040]"></i></p>
            <h1>Your Order Has Been Confirmed!</h1>
        </div> <!-- order-success-text -->

        <div class="order-success-button text-center">
            <a href="{{route('member.index')}}"><button class="bg-[#8CC040] py-[10px] px-[100px] text-[#FFFCF0] rounded-full duration-700 hover:scale-105">Go to Dashboard <i class="fa-solid fa-arrow-right"></i></button></a>
        </div> <!-- order-success-button -->
    </div> <!-- bg-success-page -->
</main>
@endsection