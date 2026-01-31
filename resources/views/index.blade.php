<x-app-layout>
  <section
    style="background-image: url('storage/images/landingSalad.png')"
    class="bg-hero-banner flex h-[70svh] items-center bg-cover bg-center bg-no-repeat leading-relaxed lg:h-[813px] lg:py-[151px] xl:h-[90lvh]"
  >
    <div
      class="hero-text flex h-[50svh] w-full flex-col items-center justify-center bg-yellow-rgba-84 text-[#282222] xl:h-[519px]"
    >
      <h1 class="mb-4 text-xl font-semibold capitalize sm:text-3xl lg:text-4xl">Meals cooked for everyone</h1>
      <p
        class="mx-10 text-center text-sm font-medium leading-relaxed sm:mx-0 sm:max-w-md sm:text-pretty sm:text-base lg:mt-5 lg:text-base xl:max-w-xl"
      >
        Thousands of volunteers and caregivers are ready to help vulnerable seniors and people with disabilities across
        the nation. Health and prosperity for livings will be our priority for everyone.
      </p>
    </div>
    <!-- hero-text -->
  </section>

  <!-- section-serve -->
  <section class="bg-light">
    <div
      class="mx-auto flex w-full max-w-screen-2xl flex-col justify-center gap-4 px-8 py-20 lg:min-h-[80lvh] lg:flex-row lg:items-center lg:gap-12"
    >
      <div class="order-1 flex w-full flex-col items-center justify-center gap-6 lg:pl-10">
        <h1
          class="w-full text-center text-xl font-semibold capitalize sm:max-w-sm sm:text-pretty sm:text-3xl lg:max-w-md lg:self-start lg:text-left lg:text-4xl lg:leading-tight"
        >
          we
          <span class="text-primary">serve</span>
          the best of humanity
        </h1>
        <img
          class="block w-9/12 rounded-lg sm:w-7/12 lg:hidden"
          src="{{ asset('storage/images/aboutUsImage.jpg') }}"
          alt="granma-image"
        />
        <p
          class="w-10/12 text-pretty text-center text-sm font-medium leading-relaxed sm:max-w-md sm:text-base lg:self-start lg:text-left"
        >
          Merry Meals service works virtually throughout the region of the Indonesia archipelago. Our staff and
          volunteers will prioritize being in areas where there are many vulnerable and people with disability.
        </p>
        <div class="hidden self-start lg:block lg:w-9/12">
          <x-button
            :type="App\Enum\ButtonType::OutlineHover"
            :route="route('index')"
            :classes="'!border-accentSecondary !text-accentSecondary hover:!border-accentSecondary hover:!bg-accentSecondary hover:!text-dark'"
            :title="'learn more button'"
          >
            Learn More About Merry Meals
          </x-button>
        </div>
      </div>
      <div class="order-2 w-full lg:order-3">
        <img
          class="mx-auto hidden w-9/12 rounded-lg shadow sm:w-7/12 lg:block lg:w-full xl:w-9/12"
          src="{{ asset('storage/images/aboutUsImage.jpg') }}"
          alt="granma-image"
        />
      </div>
      <div class="order-3 flex w-full justify-center lg:order-2 lg:hidden">
        <x-button
          :type="App\Enum\ButtonType::OutlineHover"
          :route="route('index')"
          :classes="'!border-accentSecondary !text-accentSecondary hover:!border-accentSecondary hover:!bg-accentSecondary hover:!text-dark'"
          :title="'learn more button'"
        >
          Learn More About Merry Meals
        </x-button>
      </div>
    </div>
  </section>

  <section
    style="background-image: url('storage/images/landingPageImage3Edited.jpg')"
    class="section-healthy flex h-[60svh] w-full items-center text-pretty bg-cover bg-left bg-no-repeat py-[86px] leading-relaxed lg:h-[50lvh] lg:min-h-[80lvh]"
  >
    <div
      class="healthy-text flex w-full flex-col space-y-[35px] rounded-lg bg-light p-6 py-20 text-dark sm:items-center sm:text-pretty lg:ml-auto lg:h-[489px] lg:w-[857px] lg:py-[107px] lg:pl-[57px] 2xl:min-w-[1280px]"
    >
      <h1
        class="text-center text-xl font-semibold sm:max-w-md sm:text-3xl lg:text-left lg:text-[40px] lg:leading-tight"
      >
        Healthy food to live a healthier life in the future
      </h1>
      <p
        class="h-[60px] w-full text-pretty text-center text-sm font-medium leading-relaxed sm:max-w-md sm:text-base lg:w-[651px] lg:text-left lg:text-lg"
      >
        By eating healthy foods that have extraordinary flavors that make your life healthier for today and in the
        future
      </p>
    </div>
    <!-- healthy-text -->
  </section>
  <!-- section-healthy -->

  <section
    class="section-charity flex w-full items-center justify-center bg-secondary px-6 py-24 leading-relaxed xl:min-h-[50dvh]"
  >
    <div
      class="section-charity-content flex w-full flex-col items-center justify-center gap-8 text-center text-[#282222] xl:space-y-[71px]"
    >
      <h1 class="text-3xl font-semibold sm:w-[358px] sm:max-w-md sm:text-pretty xl:text-[40px] xl:leading-tight">
        Charity is an act of a soft heart
      </h1>
      <p
        class="w-full text-pretty text-center text-sm font-medium leading-relaxed sm:max-w-md sm:text-base xl:max-w-screen-md xl:text-xl"
      >
        Merry Meal is a humanitarian platform that carries the concept of sharing for fellow human beings. Through Merry
        Meal, you can donate to whom that need the most. Let’s start your action of help!
      </p>

      <a href="{{ route('donation') }}" class="font-semibold">
        <button
          class="z-1 h-[271px] w-[271px] rounded-lg bg-gradient-to-t from-[#FFA800] to-[#FFCE01] px-[61px] py-[75px] text-justify text-[40px] text-[#FFFDF6] duration-500 hover:scale-105"
        >
          Donate Now
          <i class="fa fa-solid fa-right-long"></i>
        </button>
      </a>
    </div>
    <!-- section-charity-content -->
  </section>
  <!-- section-charity -->
</x-app-layout>
