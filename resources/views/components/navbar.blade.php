<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body class="font-poppins">
  <header class="bg-navbar bg-[#FFFCF0] h-[211px] flex flex-col w-full">
    <div class="navbar-top bg-[#FFFCF0] h-[149px] flex flex-row justify-between py-[25px] px-[147px]">

      <div class="logo flex flex-row space-x-[37px] ">
        <div class="logo-image h-[104px] w-[105px]">
          <img src="images/MerryMealLogo-02.png" alt="logo_image">
        </div> <!-- logo-image -->

        <div class="flex flex-row items-center">
          <div class="logo-name flex flex-col text-[#EDB01C] font-semibold h-[73px] w-[321px] space-y-[-15px]">
            <h1 class="text-[36px] tracking-[10px]">MERRY MEAL</h1>
            <h2 class="text-[24px] tracking-[7px]">MEALS ON WHEELS</h2>
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


  <!-- <div class="navbar bg-accent shadow-lg">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
          <li><a>Item 1</a></li>
          <li tabindex="0">
            <a class="justify-between">
              Parent
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
              </svg>
            </a>
            <ul class="p-2">
              <li><a>Submenu 1</a></li>
              <li><a>Submenu 2</a></li>
            </ul>
          </li>
          <li><a>Item 3</a></li>
        </ul>
      </div>
      <a class="btn btn-ghost normal-case text-xl">daisyUI</a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal p-0">
        <li><a>Item 1</a></li>
        <li tabindex="0">
          <a>
            Parent
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
            </svg>
          </a>
          <ul class="p-2">
            <li><a>Submenu 1</a></li>
            <li><a>Submenu 2</a></li>
          </ul>
        </li>
        <li><a>Item 3</a></li>
      </ul>
    </div>
    <div class="navbar-end">
      <a class="btn w-42">Sign In</a>
    </div>
  </div> -->
</body>

</html>
