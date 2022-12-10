@extends('layout.main')
@section('component_content')
<main class="bg-[#FFFCF0] w-full min-h-screen max-h-fit">
    @include('components.navbar')
    <div class="bg-content px-[147px] py-[110px]">
        <div class="meal-page-title text-[#282222] mb-[53px]">
            <h1 class="font-semibold text-[40px]">Menu Package</h1>
            <h2 class="text-[16px] italic">All food packages can be ordered <b>one per order</b></h2>
        </div> <!-- meal-page-title -->
        <div class="grid grid-cols-3 gap-[80px] flex-row">
            @foreach($meals as $meal)
            <div class="card-meal w-full bg-[#FFFCF0] h-[500px] flex flex-col shadow-xl rounded-xl">
                <div class="sub-image w-full">
                    <img src="{{ asset( 'storage/' . $meal->mealImage) }}" class="object-cover w-full h-[185px] rounded-t-xl"
                        alt="Meal-image">
                </div> <!-- sub-image -->

                <div class="desc flex flex-col justify-evenly">
                    <div
                        class="card-meal-desc text-[#282222] text-[16px] items-center flex flex-col space-y-[15px] p-[44px]">
                        <h2 class="font-semibold">
                            {{$meal->mealName}}
                        </h2>

                        <p class="font-normal text-justify tracking-tight break-words">
                            {{$meal->mealIngredient}}
                        </p>
                        <p class="font-normal text-justify tracking-tight break-words">
                            {{$meal->mealDescription}}
                        </p>
                        <p class="font-normal text-justify tracking-tight break-words">
                            {{$meal->mealAvailability}}
                        </p>
                    </div> <!-- card-meal-desc -->

                    <div class="button-order p-[44px]">
                        <a href="{{ route('meal.detail', $meal->id) }}"><button
                                class="w-full bg-[#EDB01C] text-[#FFFCF0] p-[10px] rounded-xl hover:scale-105 duration-700">Order
                                Now</button></a>
                    </div> <!-- button-order -->
                </div> <!-- desc -->
            </div> <!-- card-meal -->
            @endforeach

        </div> <!-- container-2 -->
    </div> <!-- bg-content -->
    @include('components.footer')
</main> <!-- container -->
@endsection