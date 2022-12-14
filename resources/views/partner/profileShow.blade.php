@extends('partner.dashboard')
@section('partnerContent')
<main class="font-poppins">
    <div class="form-register-fields w-full pr-[5rem] mx-[10px]">
        @foreach($partners as $partner)
        @if ($partner->userID == auth()->user()->id)

        <div class="bg-partner">
        <form action="" class="flex flex-col space-y-[24px]" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="partner-name flex flex-row justify-between">
                <h1 class="text-[#282222] text-[32px] font-semibold">{{ $partner->restaurantName }}</h1>
                <h1 class="capitalize text-[#FFFDF6] text-[20px] font-semibold bg-[#282222] py-[5px] px-[50px] flex items-center">{{ $partner->foodType }}</h1>
            </div> <!-- partner-name -->

            <div class="restaurant-image">
                <img class="object-cover w-full h-[268px]" src="{{ asset('storage/' . $partner->restaurantImage) }}" alt="">            
            </div> <!-- restaurant-image -->
            
            <div class="owner flex flex-row justify-start space-x-[20px] text-[#282222] text-[20px] font-semibold">
                <h1 class="font-normal"><i class="fa-solid fa-house-user"></i> {{ $partner->ownerName }}</h1>
                <h1><i class="fa-solid fa-phone"></i> {{ $partner->restaurantContact }}</h1>
            </div> <!-- owner -->
            <h1><i class="fa-solid fa-map-location"></i> {{ $partner->restaurantAddress }}</h1>                       
            
        </form>
        </div> <!-- bg-partner -->
        
        @endif
        @endforeach
    </div> <!-- form-register-fields -->
</main>
@endsection