<x-app-layout>
  <div class="bg-[#FFFCF0]">
    <!-- content1 -->
    <div
      class="font-Poppins flex h-auto flex-col items-center justify-between text-pretty bg-[#FFE383] px-6 leading-relaxed text-[#282222] md:flex-row md:px-0"
    >
      <!-- Text Section -->
      <div
        class="mt-[50px] flex h-full w-full flex-1 flex-col justify-center space-y-4 px-6 md:mt-[100px] md:w-auto md:pl-[147px]"
      >
        <h1 class="font-Poppins text-[28px] font-bold text-[#282222] sm:text-[32px] md:text-[48px] lg:text-[64px]">
          Our Mission
        </h1>
        <p class="font-Poppins text-justify text-[14px] text-[#282222] sm:text-[16px] md:text-[18px] lg:text-[20px]">
          The most vulnerable elderly and individuals with disabilities in Indonesia are presently confronting extreme
          food insecurity. Merry Meal continues to expand to satisfy the rising need for healthy and inexpensive meals.
        </p>
      </div>

      <!-- Image Section -->
      <div class="mt-[20px] flex h-full w-full flex-1 justify-center md:mt-0 md:w-auto md:justify-end">
        <img
          class="h-auto w-full max-w-full object-cover md:w-auto"
          src="{{ asset('storage/images/peopleGathering.jpg') }}"
          alt="aboutUs"
        />
      </div>
    </div>

    <!-- content2 -->
    <div
      class="font-Poppins flex h-fit w-full flex-col justify-center text-pretty bg-[#FFFCF0] px-6 pt-[80px] leading-relaxed text-[#282222] sm:px-[147px] sm:pt-[163px]"
    >
      <div class="flex w-full flex-col justify-center">
        <h1 class="mb-[20px] text-[28px] font-bold sm:mb-[30px] sm:text-[40px]">What is Merry Meal</h1>

        <div
          class="about-us-paragraph flex flex-col space-y-[20px] text-justify text-[16px] sm:space-y-[30px] sm:text-[20px]"
        >
          <p>
            Merry Meal provides healthy, tasty, and cheap meals to a number of populations, including elderly, those
            with physical disabilities and cognitive impairments, people who are ill or recuperating from surgery, and
            others who require special dietary planning and support.
          </p>
          <p>
            The majority of Merry Meal initiatives in Indonesia were launched by local groups that noticed a need to
            assist feed the elderly in their areas. The programs are still run at the local level today. Programs differ
            greatly in terms of size, service given, organization, and finance.
          </p>
          <p>
            The bulk of our programs provide hot and ready-to-eat meals, while others offer frozen meals in
            microwave-ready containers. Some hot meal programs offer an additional frozen meal in the days preceding a
            weekend or holiday when there would otherwise be none.
          </p>
        </div>
      </div>
    </div>

    <!-- content3 -->
    <div
      class="bg-constribution h-fit w-full text-pretty bg-[#FFFCF0] px-6 py-[100px] leading-relaxed sm:px-[147px] sm:py-[216px]"
    >
      <div class="constribution flex w-full flex-col space-y-[50px] text-center text-[#282222] sm:space-y-[84px]">
        <div class="constribution-text">
          <h1 class="text-[28px] font-semibold sm:text-[40px]">Our contributions on communities</h1>
        </div>

        <!-- Icons Section -->
        <div class="constribution-icons grid h-fit w-full grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-8 lg:grid-cols-4">
          <!-- Icon 1 -->
          <div class="bg-i-fork flex flex-col items-center justify-center">
            <div
              class="i-fork flex h-[120px] w-[120px] items-center justify-center rounded-[50%] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] text-[50px] text-[#FFFCF0] sm:h-[177px] sm:w-[177px] sm:text-[75px]"
            >
              <i class="fa-solid fa-utensils"></i>
            </div>
            <h2 class="mt-[16px] text-[20px] font-semibold text-[#282222] sm:mt-[26px] sm:text-[24px]">2,000</h2>
            <h3 class="text-[16px] font-normal text-[#282222] sm:text-[20px]">Meals Delivered</h3>
          </div>

          <!-- Icon 2 -->
          <div class="bg-i-user flex flex-col items-center justify-center">
            <div
              class="i-user flex h-[120px] w-[120px] items-center justify-center rounded-[50%] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] text-[50px] text-[#FFFCF0] sm:h-[177px] sm:w-[177px] sm:text-[75px]"
            >
              <i class="fa-solid fa-user"></i>
            </div>
            <h2 class="mt-[16px] text-[20px] font-semibold text-[#282222] sm:mt-[26px] sm:text-[24px]">527</h2>
            <h3 class="text-[16px] font-normal text-[#282222] sm:text-[20px]">Individuals Served</h3>
          </div>

          <!-- Icon 3 -->
          <div class="bg-i-handlove flex flex-col items-center justify-center">
            <div
              class="i-handlove flex h-[120px] w-[120px] items-center justify-center rounded-[50%] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] text-[50px] text-[#FFFCF0] sm:h-[177px] sm:w-[177px] sm:text-[75px]"
            >
              <i class="fa-solid fa-hand-holding-heart"></i>
            </div>
            <h2 class="mt-[16px] text-[20px] font-semibold text-[#282222] sm:mt-[26px] sm:text-[24px]">31</h2>
            <h3 class="text-[16px] font-normal text-[#282222] sm:text-[20px]">Received Partner Funding</h3>
          </div>

          <!-- Icon 4 -->
          <div class="bg-i-person flex flex-col items-center justify-center">
            <div
              class="i-person flex h-[120px] w-[120px] items-center justify-center rounded-[50%] bg-gradient-to-t from-[#FFA800] to-[#FFCE01] text-[50px] text-[#FFFCF0] sm:h-[177px] sm:w-[177px] sm:text-[75px]"
            >
              <i class="fa-solid fa-person-walking-with-cane"></i>
            </div>
            <h2 class="mt-[16px] text-[20px] font-semibold text-[#282222] sm:mt-[26px] sm:text-[24px]">73%</h2>
            <h3 class="text-[16px] font-normal text-[#282222] sm:text-[20px]">Recipients 58+ Years</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
