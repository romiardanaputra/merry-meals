<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
</head>

<body class="font-poppins">
  <footer class="bg-footer h-[754px] bg-[#FFDE6C] flex flex-col w-full">

    <div class="footer px-[90px] py-[334px] bg-[#FFDE6C]">
      <div class="footer-content flex flex-row h-[245px] w-full justify-between items-center">

        <div class="footer-content-logo flex flex-row space-x-[20px] items-center p-[57px]">
          <div class="f-c-logo-image h-[125px] w-[125px] bg-[#FFFDF6] flex items-center justify-center rounded-[50%]">
            <img src="images/MerryMealLogo-02.png" alt="logo_image" class="h-[64px] w-[64px]">
          </div> <!-- f-c-logo-image -->

          <div
            class="f-c-logo-name flex flex-col text-[#282222] font-semibold h-[73px] w-[321px] space-y-[10px] py-[15px]">
            <h1 class="text-[36px] tracking-[10px]">MERRY MEAL</h1>
            <h2 class="text-[24px] tracking-[7px]">MEALS ON WHEELS</h2>
          </div> <!-- f-c-logo-name -->
        </div> <!-- footer-content-logo -->

        <div class="footer-content-navigation flex flex-row p-[57px] space-x-[57px] items-center">
          <div class="footer-content-company flex flex-col text-[#282222] text-[16px] space-y-[17px]">
            <h1 class="font-bold">Company</h1>
            <a href="">About Us</a>
            <a href="">Contact Us</a>
            <a href="">Terms & Conditions</a>
          </div> <!-- footer-content-company -->

          <div class="vertical-line border-[1px] h-[245px] border-[#282222]"></div>

          <div class="footer-content-register flex flex-col space-y-[26px]">
            <div class="footer-content-register-heading">
              <h1 class="font-bold">Sign up to be a member </br> or a volunteer</h1>
            </div> <!-- footer-content-register-heading -->

            <div class="footer-content-register-button">
              <a href=""><button
                  class="h-[44px] w-[195px] bg-[#282222] text-[#FFFDF6] text-[16px]">Register</button></a>
            </div> <!-- footer-content-register-button -->
          </div> <!-- footer-content-register -->
        </div> <!-- footer-content-navigation -->

      </div> <!-- footer-content -->
    </div> <!-- footer -->

    <div class="footer-copyright w-fit px-[290px] mt-[-70px]">
      <h1>&copy; 2022 All Rights Reserved | Merry Meal</h1>
    </div> <!-- footer-copyright -->

  </footer> <!-- bg-footer -->
</body>

</html>