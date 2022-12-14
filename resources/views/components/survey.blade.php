@extends('layout.main')

<style>
   .survey-reaction-style [type="radio"] {
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
   }

   .survey-reaction-style [type="radio"]+label>img {
      cursor: pointer;
      filter: grayscale(1);
      transition: 0.7s;
   }

   .survey-reaction-style [type="radio"]:checked+label>img {
      filter: grayscale(0);
      transform: scale(1.05);
   }
</style>

@section('component_content')

<navbar class="font-poppins">
   <div class="bg-navbar bg-[#282222] h-[187px] w-full p-[40px] flex flex-row justify-between">
      <div class="bg-nav-logo flex flex-row space-x-[37px]">

         <div class="flex flex-col items-center justify-center">
            <div class="logo-image bg-[#FFFDF6] p-[10px] rounded-[50%] h-[55px] w-[55px]">
               <img src="/images/MerryMealLogo-02.png" alt="logo_image">
            </div> <!-- logo-image -->
         </div> <!-- logo-flex -->

         <div class="flex flex-col items-center justify-center">
            <div class="logo-name flex flex-col text-[#FFFDF6] font-semibold w-[500px] space-y-[-10px]">
               <h1 class="text-[20px] tracking-[10px] w-full">MERRY MEAL</h1>
               <h2 class="text-[12.5px] tracking-[7.2px] w-full">MEALS ON WHEELS</h2>
            </div> <!-- logo-name -->
         </div> <!-- logo-name-items-center -->

      </div> <!-- bg-nav-logo -->
   </div> <!-- bg-navbar -->
</navbar>

<main class="font-poppins">

   <div class="bg-survey min-h-screen max-h-fit px-[439px] py-[55px]">

      <form action="{{ route('survey.store') }}" class="flex flex-row items-center justify-center" method="POST">
         @csrf
         <div class="survey-question flex flex-col space-y-[90px]">

            <!-- Survey1 -->
            <div class="survey-1 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">1. How did you find Merry Meals?</h1>

               <div class="radio-survey-search">
                  <input type="radio" name="questionOne" id="surveySearch" value="surveySearch" required>
                  <label for="surveySearch">Search</label>
               </div> <!-- radio-survey-search -->

               <div class="radio-survey-friends">
                  <input type="radio" name="questionOne" id="surveyFriends" value="surveyFriends" required>
                  <label for="surveyFriends">Friends</label>
               </div> <!-- radio-survey-friends -->

               <div class="radio-survey-advertisements">
                  <input type="radio" name="questionOne" id="surveyAdvertisements" value="surveyAdvertisements" required>
                  <label for="surveyAdvertisements">Advertisements</label>
               </div> <!-- radio-survey-advertisements -->
            </div> <!-- survey-1 -->

            <!-- Survey2 -->
            <div class="survey-2 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">2. What was your first impression about our website?</h1>

               <div class="survey-impression">
                  <textarea name="questionTwo" id="questionTwo" required
                     class="p-[20px] border-2 border-[#282222] w-full"></textarea>
               </div> <!-- survey-impression -->
            </div> <!-- survey-2 -->

            <!-- Survey3 -->
            <div class="survey-3 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">3. Did you find this website accessible to you?</h1>

               <div class="radio-survey-accessible">
                  <input type="radio" name="questionThree" id="surveyAccessible" value="surveyAccessible"
                     required>
                  <label for="surveyAccessible">Accessible</label>
               </div> <!-- radio-survey-accessible -->

               <div class="radio-survey-neutral">
                  <input type="radio" name="questionThree" id="surveyAccessNeutral" value="surveyAccessNeutral"
                     required>
                  <label for="surveyAccessNeutral">Neutral</label>
               </div> <!-- radio-survey-neutral -->

               <div class="radio-survey-inaccessible">
                  <input type="radio" name="questionThree" id="surveyInaccessible" value="surveyInaccessible"
                     required>
                  <label for="surveyInaccessible">Inaccessible</label>
               </div> <!-- radio-survey-inaccessible -->
            </div> <!-- survey-3 -->

            <!-- Survey4 -->
            <div class="survey-4 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">4. Did you able to order a food?</h1>

               <div class="radio-survey-yes">
                  <input type="radio" name="questionFour" id="surveyYes" value="surveyYes" required>
                  <label for="surveyYes">Yes</label>
               </div> <!-- radio-survey-yes -->

               <div class="radio-survey-no">
                  <input type="radio" name="questionFour" id="surveyNo" value="surveyNo" required>
                  <label for="surveyNo">No</label>
               </div> <!-- radio-survey-no -->
            </div> <!-- survey-4 -->

            <!-- Survey5 -->
            <div class="survey-5 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">5. How was your food ordering experience?</h1>

               <div class="survey-ordering-experience">
                  <textarea name="questionFive" id="questionFive" required
                     class="p-[20px] border-2 border-[#282222] w-full"></textarea>
               </div> <!-- survey-ordering-experience -->
            </div> <!-- survey-5 -->

            <!-- Survey6 -->
            <div class="survey-6 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">6. How was your food delivery experience?</h1>

               <div class="survey-delivery-experience">
                  <textarea name="questionSix" id="questionSix" required
                     class="p-[20px] border-2 border-[#282222] w-full"></textarea>
               </div> <!-- survey-delivery-experience -->
            </div> <!-- survey-6 -->

            <!-- Survey7 -->
            <div class="survey-7 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">7. How useful our services to you?</h1>

               <div class="radio-survey-very-useful">
                  <input type="radio" name="questionSeven" id="surveyVeryUseful" value="surveyVeryUseful"
                     required>
                  <label for="surveyVeryUseful">Very Useful</label>
               </div> <!-- radio-survey-very-useful -->

               <div class="radio-survey-useful">
                  <input type="radio" name="questionSeven" id="surveyUseful" value="surveyUseful" required>
                  <label for="surveyUseful">Useful</label>
               </div> <!-- radio-survey-useful -->

               <div class="radio-survey-neutral">
                  <input type="radio" name="questionSeven" id="surveyServiceNeutral"
                     value="surveyServiceNeutral" required>
                  <label for="surveyServiceNeutral">Neutral</label>
               </div> <!-- radio-survey-neutral -->

               <div class="radio-survey-useless">
                  <input type="radio" name="questionSeven" id="surveyUseless" value="surveyUseless" required>
                  <label for="surveyUseless">Useless</label>
               </div> <!-- radio-survey-useless -->

               <div class="radio-survey-extremely-useless">
                  <input type="radio" name="questionSeven" id="surveyExtremelyUseless"
                     value="surveyExtremelyUseless" required>
                  <label for="surveyExtremelyUseless">ExtremelyUseless</label>
               </div> <!-- radio-survey-extremely-useless -->
            </div> <!-- survey-7 -->

            <!-- Survey8 -->
            <div class="survey-8 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">8. How do you recommend this website to your friends?</h1>

               <div class="radio-survey-very-recommend">
                  <input type="radio" name="questionEight" id="surveyVeryRecommend" value="surveyVeryRecommend"
                     required>
                  <label for="surveyVeryRecommend">Very Recommend</label>
               </div> <!-- radio-survey-very-recommend -->

               <div class="radio-survey-recommend">
                  <input type="radio" name="questionEight" id="surveyRecommend" value="surveyRecommend"
                     required>
                  <label for="surveyRecommend">Recommend</label>
               </div> <!-- radio-survey-recommend -->

               <div class="radio-survey-not-recommend">
                  <input type="radio" name="questionEight" id="surveyNotRecommend" value="surveyNotRecommend"
                     required>
                  <label for="surveyNotRecommend">Not Recommend</label>
               </div> <!-- radio-survey-not-recommend -->

               <div class="radio-survey-extremely-not-recommend">
                  <input type="radio" name="questionEight" id="surveyExtremelyNotRecommend"
                     value="surveyExtremelyNotRecommend" required>
                  <label for="surveyExtremelyNotRecommend">Extremely Not Recommend</label>
               </div> <!-- radio-survey-extremely-not-recommend -->
            </div> <!-- survey-8 -->

            <div class="rate-title text-[#282222] text-[36px] font-bold text-center">
               <h1>How do you rate us overall?</h1>
            </div> <!-- rate-title -->

            <div class="survey-rate flex flex-row justify-between">

               <div class="survey-reaction-style h-[122px] w-[122px] hover:scale-105 duration-700">
                  <input type="radio" name="overall" value="sadReaction" id="sadReaction">
                  <label for="sadReaction">
                     <img src="/images/SadEmoticon.png" alt="sadReaction">
                  </label>
               </div>

               <div class="survey-reaction-style h-[122px] w-[122px] hover:scale-105 duration-700">
                  <input type="radio" name="overall" value="neutralReaction" id="neutralReaction">
                  <label for="neutralReaction">
                     <img src="/images/NeutralEmoticon.png" alt="neutralReaction">
                  </label>
               </div>

               <div class="survey-reaction-style h-[122px] w-[122px] hover:scale-105 duration-700">
                  <input type="radio" name="overall" value="happyReaction" id="happyReaction">
                  <label for="happyReaction">
                     <img src="/images/HappyEmoticon.png" alt="happyReaction">
                  </label>
               </div>

            </div> <!-- survey-rate -->

            <div class="survey-submit-button flex flex-row space-x-[20px] justify-center items-center text-[#FFFDF6]">
               <button type="submit"
                  class="bg-[#4CAF3C] h-[50px] w-fit px-[50px] duration-700 hover:scale-105">Submit</button>
               
            </div> <!-- survey-submit-button -->

         </div> <!-- survey-question -->

      </form>
      <div class="button-cancel flex justify-center">
         <a href="{{ route('member.index') }}">
            <button class="bg-[#AF433C] h-[50px] w-fit px-[50px] duration-700 hover:scale-105 text-[#FFFDF6]">Cancel</button>
         </a>
      </div> <!-- button-cancel -->
   </div> <!-- bg-survey -->

</main>

<footer class="font-poppins bg-footer h-[754px] bg-[#282222] flex flex-col w-full">

   <div class="footer px-[90px] py-[334px] bg-[#282222]">
      <div class="footer-content flex flex-row h-[245px] w-full justify-between items-center">

         <div class="footer-content-logo flex flex-row space-x-[20px] items-center p-[57px]">
            <div class="f-c-logo-image h-[125px] w-[125px] bg-[#FFFDF6] flex items-center justify-center rounded-[50%]">
               <img src="/images/MerryMealLogo-02.png" alt="logo_image" class="h-[64px] w-[64px]">
            </div> <!-- f-c-logo-image -->

            <div
               class="f-c-logo-name flex flex-col text-[#FFFDF6] font-semibold h-[73px] w-[500px] space-y-[10px] py-[15px]">
               <h1 class="text-[36px] tracking-[10px] w-full">MERRY MEAL</h1>
               <h2 class="text-[24px] tracking-[7px] w-full">MEALS ON WHEELS</h2>
            </div> <!-- f-c-logo-name -->
         </div> <!-- footer-content-logo -->

         <div class="footer-content-navigation flex flex-row p-[57px] space-x-[57px] items-center">
            <div class="footer-content-company flex flex-col text-[#FFFDF6] text-[16px] space-y-[17px]">
               <h1 class="font-bold">Company</h1>
               <a href="{{ route('about') }}" class="hover:scale-105 duration-500">About Us</a>
               <a href="{{ route('contact') }}" class="hover:scale-105 duration-500">Contact Us</a>
               <a href="{{ route('term') }}" class="hover:scale-105 duration-500">Terms & Conditions</a>
            </div> <!-- footer-content-company -->

            <div class="vertical-line border-[1px] h-[245px] border-[#FFFDF6]"></div>

            @guest
            <div class="footer-content-register flex flex-col space-y-[26px]">
               <div class="footer-content-register-heading">
                  <h1 class="font-bold">Sign up to be a member <br /> or a volunteer</h1>
               </div> <!-- footer-content-register-heading -->

               <div class="footer-content-register-button">
                  <a href="{{ route('register.index') }}"><button
                        class="h-[44px] w-[195px] bg-[#282222] text-[#FFFDF6] text-[16px] hover:scale-105 duration-500">Register</button></a>
               </div> <!-- footer-content-register-button -->
            </div> <!-- footer-content-register -->
            @endguest
         </div> <!-- footer-content-navigation -->

      </div> <!-- footer-content -->
   </div> <!-- footer -->

   <div class="footer-copyright w-full px-[290px] mt-[-70px] text-[#FFFDF6] border-t-2 border-[#FFFDF6]">
      <h1 class="mt-[15px]">&copy; 2022 All Rights Reserved | Merry Meal</h1>
   </div> <!-- footer-copyright -->

</footer> <!-- bg-footer -->

@endsection