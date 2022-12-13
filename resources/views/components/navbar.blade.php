<section class="font-poppins">
  <header class="bg-navbar bg-[#FFFCF0] h-[211px] flex flex-col w-full sticky top-0 z-10">
    <div class="navbar-top bg-[#FFFCF0] h-[149px] flex flex-row justify-between py-[25px] px-[147px]">

      <div class="logo flex flex-row space-x-[37px] ">
        <div class="logo-image h-[104px] w-[105px]">
          <img src="/images/MerryMealLogo-02.png" alt="logo_image">
        </div> <!-- logo-image -->

        <div class="flex flex-row items-center">
          <div class="logo-name flex flex-col text-[#EDB01C] font-semibold h-[73px] w-[500px] space-y-[-15px]">
            <h1 class="text-[36px] tracking-[10px] w-full">MERRY MEAL</h1>
            <h2 class="text-[24px] tracking-[7px] w-full">MEALS ON WHEELS</h2>
          </div> <!-- logo-name -->
        </div> <!-- logo-name-items-center -->
      </div> <!-- logo -->

      <div class="nav-login-register flex flex-row my-auto space-x-[18.57px] text-[#282222]">
        @auth
        @if (auth()->user()->role == 'member' || auth()->user()->role == 'donor')
        <a href="{{ route('member.index') }}"><button
            class="bg-[#FFCE01] {{ Request::is('member/dashboard') ? 'bg-[#282222] text-[#FFCE01]' : '' }} h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700 ">{{
            auth()->user()->username }}</button></a>
        @elseif(auth()->user()->role == 'admin')
        <a href="{{ route('admin.index') }}"><button
            class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700 ">{{
            auth()->user()->username }}</button></a>
        @elseif(auth()->user()->role == 'partner')
        <a href="{{ route('partner.index') }}"><button
            class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700 ">{{
            auth()->user()->username }}</button></a>
        @endif

        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <a href="#"><button type="submit"
              class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">LOGOUT</button></a>
        </form>
        @else
        <a href="{{ route('login') }}"><button
            class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">SIGN
            IN</button></a>
        <a href="{{ route('register.index') }}"><button
            class="bg-[#FFCE01] h-[47px] w-[115.61px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">JOIN
          </button></a>
        @endauth
      </div> <!-- nav-login-register -->

    </div> <!-- navbar-top -->

    <div class="navbar-bottom bg-[#FFCE01] flex flex-row justify-center">
      @auth

      @if (Auth::user()->role == 'member' || Auth::user()->role == 'donor')
      <a href="{{ route('meal.menu') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('member/menu') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">MENU</button></a>
      <a href="{{ route('donation') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('donate') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">DONATE</button></a>
      <a href="{{ route('contact') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('contact') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">CONTACT</button></a>

      @else
      <a href="{{ route('landing.index') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('/') ? 'bg-[#282222] text-[#fffcf0]' : '' }} ">HOME</button></a>
      <a href="{{ route('about') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('about') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">ABOUT</button></a>
      <a href="{{ route('contact') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('contact') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">CONTACT</button></a>
      <a href="{{ route('term') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('term') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">TERMS
          & CONDITIONS</button></a>
      <a href="{{ route('donation') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('donate') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">DONATE</button></a>
      
      @endif

      @endauth

      @guest
      <a href="{{ route('landing.index') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('/') ? 'bg-[#282222] text-[#fffcf0]' : '' }} ">HOME</button></a>
      <a href="{{ route('about') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('about') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">ABOUT</button></a>
      <a href="{{ route('contact') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('contact') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">CONTACT</button></a>
      <a href="{{ route('term') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('term') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">TERMS
          & CONDITIONS</button></a>
      <a href="{{ route('donation') }}"><button
          class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500 {{ Request::is('donate') ? 'bg-[#282222] text-[#fffcf0]' : '' }}">DONATE</button></a>
      @endguest
    </div> <!-- navbar-bottom -->
  </header> <!-- bg-navbar -->
</section>
