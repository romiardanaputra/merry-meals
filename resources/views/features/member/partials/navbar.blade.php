<navbar class="font-poppins">
    <div class="bg-navbar bg-[#282222] h-[187px] w-full p-[40px] flex flex-row justify-between">
        <div class="bg-nav-logo flex flex-row space-x-[37px]">

            <div class="flex flex-col items-center justify-center">
                <div class="logo-image bg-[#FFFDF6] p-[10px] rounded-[50%] h-[55px] w-[55px]">
                    <img src={{ asset('/images/MerryMealLogo-02.png')}} alt="logo_image">
                </div> <!-- logo-image -->
            </div> <!-- logo-flex -->

            <div class="flex flex-col items-center justify-center">
                <div class="logo-name flex flex-col text-[#FFFDF6] font-semibold w-[500px] space-y-[-10px]">
                    <h1 class="text-[20px] tracking-[10px] w-full">MERRY MEAL</h1>
                    <h2 class="text-[12.5px] tracking-[7.2px] w-full">MEALS ON WHEELS</h2>
                </div> <!-- logo-name -->
            </div> <!-- logo-name-items-center -->

        </div> <!-- bg-nav-logo -->

        @if (!Request::path('survey'))
        <div class="bg-nav-homepage flex items-center justify-center">
            <a href="{!! route('meal.menu') !!}">
                <button class="text-[#FFFDF6] border-2 border-[#FFFDF6] p-[24px] duration-700 hover:scale-105">Back to
                    Homepage</button>
            </a>
        </div><!-- bg-nav-homepage -->
        @elseif(!Request::path('volunteer'))
        <div>test button</div>
        @endif
    </div> <!-- bg-navbar -->
</navbar>