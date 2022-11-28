@extends('layout.main')
@section('component_content')
<main class="bg-[#FFFCF0] font-poppins">
    @include('components.navbar')

    <div class="flex justify-center m-auto my-[70px] text-justify leading-relaxed space-x-[50px]">
        <div class="overflow-y-auto w-[563px] h-[316px]">
            <h1 class="text-[32px] text-[#282222] font-bold">Tittle</h1>

            <p class="text-[24px] text-[#282222] mt-[20px]">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur reprehenderit est deleniti, veritatis, vero excepturi dicta at numquam minus tenetur in natus sunt doloribus ad alias aliquid! Molestias, dolore perspiciatis.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat vitae, neque dolorem sapiente at eos quibusdam deleniti minima debitis corporis voluptatibus iure aspernatur blanditiis saepe dolore. Asperiores at aliquam a!
            </p>
        </div>

        <div class="flex flex-col space-y-[50px]">
            <img class="w-[562px] h-[316px]" src="images/foodThumbnail.jpg" alt="">

            <div class="flex flex-row justify-between">
                <a href="">
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