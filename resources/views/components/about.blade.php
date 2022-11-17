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
    <div class="bg-[#FFE383] font-Poppins text-[#282222] h-[490px] flex justify-center">
        <div class="w-[504px] h-[150px] mx-auto mt-[100px]">
            <h1 class="font-Poppins text-[64px] text-[#282222] font-bold">Our Mission</h1>
            <p class="font-Poppins text-[20px] text-[#282222]">The most vulnerable elderly and individuals with disabilities in Indonesia are presently confronting extreme food insecurity. Merry Meal continues to expand to satisfy the rising need for healthy and inexpensive meals.</p>
        </div>

        <div class="w-[710px] h-[108px] mt-[10px]">
            <img src="images/peopleGathering.jpg" alt="aboutUs">
        </div>
    </div>

    <!-- content2 -->
    <div class="bg-[#FFFCF0] flex justify-center font-Poppins text-[#282222] mt-[50px]">
        <div class="w-[1144px] h-[408px]">
            <h1 class="text-[40px] font-bold">
                What is Merry Meal
            </h1>

            <p class="text-[20px]">
                Merry Meal provides healthy, tasty, and cheap meals to a number of populations, including elderly, those with physical disabilities and cognitive impairments, people who are ill or recuperating from surgery, and others who require special dietary planning and support.
            </p>
            <p class="text-[20px]">
                The majority of Merry Meal initiatives in Indonesia were launched by local groups that noticed a need to assist feed the elderly in their areas. The programs are still run at the local level today. Programs differ greatly in terms of size, service given, organization, and finance.
            </p>
            <p class="text-[20px]">
                The bulk of our programs provide hot and ready-to-eat meals, while others offer frozen meals in microwave-ready containers. Some hot meal programs offer an additional frozen meal in the days preceding a weekend or holiday when there would otherwise be none.
            </p>
        </div>
    </div>

@include('components.footer')
</body>
</html>