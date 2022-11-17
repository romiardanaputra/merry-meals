<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body class="font-poppins">
  <header class="bg-navbar bg-[#FFFCF0] h-[211px] flex flex-col w-full sticky top-0 z-10">
    <div class="navbar-top bg-[#FFFCF0] h-[149px] flex flex-row justify-between py-[25px] px-[147px]">

      <div class="logo flex flex-row space-x-[37px] ">
        <div class="logo-image h-[104px] w-[105px]">
          <img src="images/MerryMealLogo-02.png" alt="logo_image">
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
          <a href="#"><button class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">{{ auth()->user()->username }}</button></a>
          <form action="/logout" method="POST">
            @csrf
            <a href="#"><button type="submit" class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">LOGOUT</button></a>
          </form>
            @else
          <a href="/login"><button class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">SIGN IN</button></a>
          <a href="/register"><button class="bg-[#FFCE01] h-[47px] w-[115.61px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">JOIN</button></a>
        @endauth
     
      </div> <!-- nav-login-register -->

    </div> <!-- navbar-top -->

    <div class="navbar-bottom bg-[#FFCE01] flex flex-row justify-center">
      <div class="nav w-max h-full">
        <a href="/"><button class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500">HOME</button></a>
        <a href=""><button class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500">ABOUT</button></a>
        <a href="/contact"><button class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500">CONTACT</button></a>
        <a href="/term"><button class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500">TERMS & CONDITIONS</button></a>
        <a href=""><button class="p-[22px] hover:bg-[#282222] hover:text-[#FFFCF0] duration-500">DONATE</button></a>
      </div> <!-- nav -->
    </div> <!-- navbar-bottom -->
  </header> <!-- bg-navbar -->
</body>

</html>
