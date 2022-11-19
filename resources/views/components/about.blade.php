<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-[#FFFCF0]">
@include('components.navbar')

    <!-- content1 -->
    <div class="bg-[#FFE383] font-Poppins text-[#282222] h-[490px] flex justify-between pl-[147px]">
        <div class="w-[504px] h-[150px] mt-[100px]">
            <h1 class="font-Poppins text-[64px] text-[#282222] font-bold">Our Mission</h1>
            <p class="font-Poppins text-[20px] text-[#282222] text-justify">The most vulnerable elderly and individuals with disabilities in Indonesia are presently confronting extreme food insecurity. Merry Meal continues to expand to satisfy the rising need for healthy and inexpensive meals.</p>
        </div>

        <div class="w-[710px] h-[108px] mt-[10px]">
            <img src="images/peopleGathering.jpg" alt="aboutUs">
        </div>
    </div>

    <!-- content2 -->
    <div class="bg-[#FFFCF0] w-full h-fit flex flex-col justify-center font-Poppins text-[#282222] px-[147px] pt-[163px]">
        <div class="w-full flex flex-col justify-center">
            <h1 class="text-[40px] font-bold mb-[30px]">
                What is Merry Meal
            </h1>
            
            <div class="about-us-paragraph text-[20px] flex flex-col space-y-[30px] text-justify">
            <p>
                Merry Meal provides healthy, tasty, and cheap meals to a number of populations, including elderly, those with physical disabilities and cognitive impairments, people who are ill or recuperating from surgery, and others who require special dietary planning and support.
            </p> 
            <p>
                The majority of Merry Meal initiatives in Indonesia were launched by local groups that noticed a need to assist feed the elderly in their areas. The programs are still run at the local level today. Programs differ greatly in terms of size, service given, organization, and finance.
            </p>    
            <p>
                The bulk of our programs provide hot and ready-to-eat meals, while others offer frozen meals in microwave-ready containers. Some hot meal programs offer an additional frozen meal in the days preceding a weekend or holiday when there would otherwise be none.
            </p>
            </div>
        </div>
    </div>

    <!-- content3 -->
    <div class="bg-constribution bg-[#FFFCF0] w-full h-fit py-[216px] px-[147px]">
        <div class="constribution text-[#282222] text-center flex flex-col space-y-[84px] w-full">
            <div class="constribution-text">                
                <h1 class="font-semibold qtext-[40px]">Our contributions on communities</h1>
            </div>

            <div class="constribution-icons w-full h-fit flex flex-row justify-between">
                <div class="bg-i-fork flex flex-col items-center justify-center">
                    <div class="i-fork h-[177px] w-[177px] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] rounded-[50%] flex items-center justify-center text-[#FFFCF0] text-[75px]"><i class="fa-solid fa-utensils"></i></div>
                    <h2 class="text-[#282222] text-[24px] font-semibold mt-[26px]">2,000</h2>
                    <h3 class="text-[#282222] text-[20px] font-normal">Meals Delivered</h3>
                </div>

                <div class="bg-i-user flex flex-col items-center justify-center">
                    <div class="i-user h-[177px] w-[177px] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] rounded-[50%] flex items-center justify-center text-[#FFFCF0] text-[75px]"><i class="fa-solid fa-user"></i></div>
                    <h2 class="text-[#282222] text-[24px] font-semibold mt-[26px]">527</h2>
                    <h3 class="text-[#282222] text-[20px] font-normal">Individuals Served</h3>
                </div>

                <div class="bg-i-handlove flex flex-col items-center justify-center">
                    <div class="i-handlove h-[177px] w-[177px] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] rounded-[50%] flex items-center justify-center text-[#FFFCF0] text-[75px]"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <h2 class="text-[#282222] text-[24px] font-semibold mt-[26px]">31</h2>
                    <h3 class="text-[#282222] text-[20px] font-normal">Received Partner Funding</h3>
                </div>

                <div class="bg-i-person flex flex-col items-center justify-center">
                    <div class="i-person h-[177px] w-[177px] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] rounded-[50%] flex items-center justify-center text-[#FFFCF0] text-[75px]"><i class="fa-solid fa-person-walking-with-cane"></i></div>
                    <h2 class="text-[#282222] text-[24px] font-semibold mt-[26px]">73%</h2>
                    <h3 class="text-[#282222] text-[20px] font-normal">Recipients 58+ Years</h3>
                </div>
            </div>
        </div>
    </div>

@include('components.footer')
</body>
</html>