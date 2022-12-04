@extends('member.dashboard')
@section('dashboard_member')
<div class="grid grid-cols-4 gap-[25px] gap-y-[50px] flex-row">
    @foreach($meals as $meal)
    <div class="card-meal w-full bg-[#FFFCF0] h-[500px] flex flex-col shadow-xl rounded-xl">
        <div class="sub-image w-full">
            <img src="{{ asset( 'storage/' . $meal->path) }}" class="object-cover w-full h-[185px] rounded-t-xl"
                alt="Meal-image">
        </div> <!-- sub-image -->

        <div class="desc flex flex-col justify-evenly">
            <div class="card-meal-desc text-[#282222] text-[16px] items-center flex flex-col space-y-[15px] p-[44px]">
                <h2 class="font-semibold">
                    {{$meal->name}}
                </h2>

                <p class="font-normal text-justify tracking-tight break-words">
                    {{$meal->ingredient}}
                </p>
            </div> <!-- card-meal-desc -->

            <div class="button-order p-[44px]">
                <a href="{{ route('member.show', $meal->id) }}"><button
                        class="w-full bg-[#EDB01C] text-[#FFFCF0] p-[10px] rounded-xl hover:scale-105 duration-700">Order
                        Now</button></a>
            </div> <!-- button-order -->
        </div> <!-- desc -->
    </div> <!-- card-meal -->
    @endforeach
</div> <!-- container-2 -->
@endsection