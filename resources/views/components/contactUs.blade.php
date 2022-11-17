<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contactUs</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-[#FFFCF0]">
@include('components.navbar')

    <!-- header -->
    <div class="w-auto h-[145px] bg-[#FFCE01] flex justify-center">
        <h1 class="font-Poppins text-[64px] text-[#282222] font-bold">
            CONTACT US
        </h1>
    </div>
    
    <!-- Content -->
    <div>
        <div class="w-[1145px] h-[581px] bg-[#FFEEB1] m-auto my-[100px]">
            <div class="font-Poppins text-[#282222] px-[30px] py-[50px]">
            
                <h3 class="text-[40px] font-bold">COMPANY SUPPORT</h3>

                <p class="text-[20px] mt-[20px]">
                    We support our partners, volunteers, and members. Regarding concern and request we would like to connect with you
                </p>

                <p class="text-[16px] mt-[80px] text-[#5E5E5E]">
                    For further question, contacts are available below:
                </p>

                <p class="text-[20px] mt-[20px]">
                    T: +62 (261) 3058270
                </p>
                <p class="text-[20px]">
                    info@merrymeal.co.i
                </p>

                <p class="text-[20px] mt-[20px]">
                    Jl. Gunungsari Sawunggaling Wonokromo Surabaya Jawa Timur
                </p>
                <p class="text-[20px]">
                   Surabaya, East Java
                </p>
                <p class="text-[20px]">
                    60264
                </p>

            </div>
        </div>
    </div>

@include('components.footer')
</body>
</html>