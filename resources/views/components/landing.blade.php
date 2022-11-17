<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

</head>
<body class="font-poppins">
    @include('components.navbar')

    <div style="background-image: url('images/landingSalad.png')" class="bg-hero-banner h-[813px] bg-no-repeat bg-center bg-cover py-[151px]">
        <div class="hero-text bg-yellow-rgba-84 h-[519px] flex flex-col justify-center items-center text-[#282222]">
            <h1 class="font-semibold text-[48px]">Meals cooked for everyone</h1>
            <h2 class="w-[1146px] text-center text-[20px] font-medium mt-[20px]">Thousands of volunteers and caregivers are ready to help vulnerable seniors and people with disabilities across the nation. Health and prosperity for livings will be our priority for everyone.</h2>
        </div> <!-- hero-text -->
    </div> <!-- bg-hero-banner -->

    <div class="section-serve h-[874px] bg-[#FFFCF0] py-[222px] pl-[147px] flex items-center">
        <div class="section-serve-content h-[431px] w-full flex flex-row justify-between space-x-[86px]">
            <div class="section-serve-content-text w-[430px] text-[#282222] flex flex-col space-y-[64px]">
                <h1 class="h-[120px] w-[362px] font-semibold text-[40px]">We serve the best of humanity</h1>

                <h2 class="h-[120px] w-[562px] font-medium text-[20px] text-justify">Merry Meals service works virtually throughout the region of the Indonesia archipelago. Our staff and volunteers will prioritize being in areas where there are many vulnerable and disabled people.</h2>

                <a href=""><button class="bg-[#FFFCF0] border-2 border-[#A07C00] text-[16px] text-[#A07C00] h-[63px] w-[370px] hover:scale-105 duration-500">Learn more about Merry Meals</button></a>
            </div> <!-- section-serve-content-text -->

            <div class="section-serve-content-image h-[430px] w-[644px]">
                <img src="images/aboutUsImage.jpg" alt="">
            </div> <!-- section-serve-content-image -->
        </div> <!-- section-serve-content -->
    </div> <!-- section-serve -->

    <div style="background-image: url('images/landingPageImage3Edited.jpg');" class="section-healthy h-[662px] w-full bg-no-repeat bg-cover bg-left py-[86px] flex justify-end">
        <div class="healthy-text pl-[57px] py-[107px] h-[489px] w-[857px] bg-[#FFFDF6] text-[#282222] flex flex-col space-y-[35px]">
            <h1 class="h-[180px] w-[371px] font-semibold text-[40px]">Healthy food to live a healthier life in the future</h1>
            <h2 class="h-[60px] w-[651px] font-medium text-[20px]">By eating healthy foods that have extraordinary flavors that make your life healthier for today and in the future</h2>
        </div> <!-- healthy-text -->
    </div> <!-- section-healthy -->

    <div class="section-charity bg-[#FFFDF6] h-[1037px] w-full py-[222px] px-[147px] flex justify-center items-center">
        <div class="section-charity-content h-[593px] w-[1144px] flex flex-col justify-center items-center space-y-[71px] text-[#282222] text-center">
            <h1 class="h-[120px] w-[358px] font-semibold text-[40px]">Charity is an act of a soft heart</h1>
            <h2 class="h-[60px] w-[1144px] text-[20px]">Merry Meal is a humanitarian platform that carries the concept of sharing for fellow human beings. <br> Through Merry Meal, you can donate to whom that need the most. Let’s start your action of help! </h2>

            <a href="" class="font-semibold"><button class="h-[271px] w-[271px] text-[40px] text-[#FFFDF6] py-[75px] px-[61px] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] hover:scale-105 duration-500 text-justify">Donate Now <i class="fa fa-solid fa-right-long"></i></button></a>
        </div> <!-- section-charity-content -->
    </div> <!-- section-charity -->

    @include('components.footer')
</body>
</html>