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
@include('components.navbarMember')
<main class="font-poppins">

   <div class="bg-survey min-h-screen max-h-fit px-[439px] py-[55px]">

      <form action="{{ route('survey.store') }}" class="flex flex-row items-center justify-center" method="POST">
         @csrf
         <div class="survey-question flex flex-col space-y-[90px]">

            <!-- Survey1 -->
            <div class="survey-1 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">1. How did you find Merry Meals?</h1>

               <div class="radio-survey-search">
                  <input type="radio" name="questionOne" id="surveySearch" value="survey" required>
                  <label for="surveySearch">Search</label>
               </div> <!-- radio-survey-search -->

               <div class="radio-survey-friends">
                  <input type="radio" name="questionOne" id="surveyFriends" value="friends" required>
                  <label for="surveyFriends">Friends</label>
               </div> <!-- radio-survey-friends -->

               <div class="radio-survey-advertisements">
                  <input type="radio" name="questionOne" id="surveyAdvertisements" value="Advertisements" required>
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
                  <input type="radio" name="questionThree" id="surveyAccessible" value="Accessible" required>
                  <label for="surveyAccessible">Accessible</label>
               </div> <!-- radio-survey-accessible -->

               <div class="radio-survey-neutral">
                  <input type="radio" name="questionThree" id="surveyAccessNeutral" value="Neutral" required>
                  <label for="surveyAccessNeutral">Neutral</label>
               </div> <!-- radio-survey-neutral -->

               <div class="radio-survey-inaccessible">
                  <input type="radio" name="questionThree" id="surveyInaccessible" value="Inaccessible" required>
                  <label for="surveyInaccessible">Inaccessible</label>
               </div> <!-- radio-survey-inaccessible -->
            </div> <!-- survey-3 -->

            <!-- Survey4 -->
            <div class="survey-4 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">4. Did you able to order a food?</h1>

               <div class="radio-survey-yes">
                  <input type="radio" name="questionFour" id="surveyYes" value="Yes" required>
                  <label for="surveyYes">Yes</label>
               </div> <!-- radio-survey-yes -->

               <div class="radio-survey-no">
                  <input type="radio" name="questionFour" id="surveyNo" value="No" required>
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
                  <input type="radio" name="questionSeven" id="surveyVeryUseful" value="Very Useful" required>
                  <label for="surveyVeryUseful">Very Useful</label>
               </div> <!-- radio-survey-very-useful -->

               <div class="radio-survey-useful">
                  <input type="radio" name="questionSeven" id="surveyUseful" value="Useful" required>
                  <label for="surveyUseful">Useful</label>
               </div> <!-- radio-survey-useful -->

               <div class="radio-survey-neutral">
                  <input type="radio" name="questionSeven" id="surveyServiceNeutral" value="Neutral" required>
                  <label for="surveyServiceNeutral">Neutral</label>
               </div> <!-- radio-survey-neutral -->

               <div class="radio-survey-useless">
                  <input type="radio" name="questionSeven" id="surveyUseless" value="Useless" required>
                  <label for="surveyUseless">Useless</label>
               </div> <!-- radio-survey-useless -->

               <div class="radio-survey-extremely-useless">
                  <input type="radio" name="questionSeven" id="surveyExtremelyUseless" value="surveyExtremelyUseless"
                     required>
                  <label for="surveyExtremelyUseless">ExtremelyUseless</label>
               </div> <!-- radio-survey-extremely-useless -->
            </div> <!-- survey-7 -->

            <!-- Survey8 -->
            <div class="survey-8 text-[#282222] text-[20px]">
               <h1 class="font-bold mb-[15px]">8. How do you recommend this website to your friends?</h1>

               <div class="radio-survey-very-recommend">
                  <input type="radio" name="questionEight" id="surveyVeryRecommend" value="Very Recommend" required>
                  <label for="surveyVeryRecommend">Very Recommend</label>
               </div> <!-- radio-survey-very-recommend -->

               <div class="radio-survey-recommend">
                  <input type="radio" name="questionEight" id="surveyRecommend" value="Recommend" required>
                  <label for="surveyRecommend">Recommend</label>
               </div> <!-- radio-survey-recommend -->

               <div class="radio-survey-not-recommend">
                  <input type="radio" name="questionEight" id="surveyNotRecommend" value="Not Recommend" required>
                  <label for="surveyNotRecommend">Not Recommend</label>
               </div> <!-- radio-survey-not-recommend -->

               <div class="radio-survey-extremely-not-recommend">
                  <input type="radio" name="questionEight" id="surveyExtremelyNotRecommend"
                     value="Extremely Not Recommend" required>
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
@include('components.footerMember')
 <!-- bg-footer -->
@endsection