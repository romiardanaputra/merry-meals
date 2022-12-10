@extends('layout.main')

<style>
   .survey-reaction-style [type="radio"]{
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .survey-reaction-style [type="radio"] + label > img{
        cursor: pointer;
        filter: grayscale(1);
        transition: 0.7s;
    }
    
    .survey-reaction-style [type="radio"]:checked + label > img{
        filter: grayscale(0);
        transform: scale(1.05);
    }
</style>

@section('component_content')
@include('components.navbar')

<main class="font-poppins">

   <div class="bg-survey min-h-screen max-h-fit px-[439px] py-[55px]">

      <form action="" class="flex flex-row items-center justify-center">

      <div class="survey-question flex flex-col space-y-[90px]">

         <!-- Survey1 -->
         <div class="survey-1 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">1. How did you find Merry Meals?</h1>

            <div class="radio-survey-search">
               <input type="radio" name="surveyFind" id="surveySearch" value="surveySearch" required>
               <label for="surveySearch">Search</label>
            </div> <!-- radio-survey-search -->

            <div class="radio-survey-friends">
               <input type="radio" name="surveyFind" id="surveyFriends" value="surveyFriends" required>
               <label for="surveyFriends">Friends</label>
            </div> <!-- radio-survey-friends -->

            <div class="radio-survey-advertisements">
               <input type="radio" name="surveyFind" id="surveyAdvertisements" value="surveyAdvertisements" required>
               <label for="surveyAdvertisements">Advertisements</label>
            </div> <!-- radio-survey-advertisements -->            
         </div> <!-- survey-1 -->

         <!-- Survey2 -->         
         <div class="survey-2 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">2. What was your first impression about our website?</h1>

            <div class="survey-impression">
               <textarea name="surveyImpression" id="surveyImpression" required class="p-[20px] border-2 border-[#282222] w-full"></textarea>               
            </div> <!-- survey-impression -->
         </div> <!-- survey-2 -->

         <!-- Survey3 -->
         <div class="survey-3 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">3. Did you find this website accessible to you?</h1>

            <div class="radio-survey-accessible">
               <input type="radio" name="surveyAccessibility" id="surveyAccessible" value="surveyAccessible" required>
               <label for="surveyAccessible">Accessible</label>
            </div> <!-- radio-survey-accessible -->

            <div class="radio-survey-neutral">
               <input type="radio" name="surveyAccessibility" id="surveyAccessNeutral" value="surveyAccessNeutral" required>
               <label for="surveyAccessNeutral">Neutral</label>
            </div> <!-- radio-survey-neutral -->

            <div class="radio-survey-inaccessible">
               <input type="radio" name="surveyAccessibility" id="surveyInaccessible" value="surveyInaccessible" required>
               <label for="surveyInaccessible">Inaccessible</label>
            </div> <!-- radio-survey-inaccessible -->            
         </div> <!-- survey-3 -->

         <!-- Survey4 -->
         <div class="survey-4 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">4. Did you able to order a food?</h1>

            <div class="radio-survey-yes">
               <input type="radio" name="surveyAbleOrder" id="surveyYes" value="surveyYes" required>
               <label for="surveyYes">Yes</label>
            </div> <!-- radio-survey-yes -->

            <div class="radio-survey-no">
               <input type="radio" name="surveyAbleOrder" id="surveyNo" value="surveyNo" required>
               <label for="surveyNo">No</label>
            </div> <!-- radio-survey-no -->                 
         </div> <!-- survey-4 -->

         <!-- Survey5 -->         
         <div class="survey-5 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">5. How was your food ordering experience?</h1>

            <div class="survey-ordering-experience">
               <textarea name="surveyOrderingExperience" id="surveyOrderingExperience" required class="p-[20px] border-2 border-[#282222] w-full"></textarea>               
            </div> <!-- survey-ordering-experience -->
         </div> <!-- survey-5 -->

         <!-- Survey6 -->         
         <div class="survey-6 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">6. How was your food delivery experience?</h1>

            <div class="survey-delivery-experience">
               <textarea name="surveyDeliveryExperience" id="surveyDeliveryExperience" required class="p-[20px] border-2 border-[#282222] w-full"></textarea>            
            </div> <!-- survey-delivery-experience -->
         </div> <!-- survey-6 -->

         <!-- Survey7 -->
         <div class="survey-7 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">7. How useful our services to you?</h1>

            <div class="radio-survey-very-useful">
               <input type="radio" name="surveyServiceUsefulness" id="surveyVeryUseful" value="surveyVeryUseful" required>
               <label for="surveyVeryUseful">Very Useful</label>
            </div> <!-- radio-survey-very-useful -->

            <div class="radio-survey-useful">
               <input type="radio" name="surveyServiceUsefulness" id="surveyUseful" value="surveyUseful" required>
               <label for="surveyUseful">Useful</label>
            </div> <!-- radio-survey-useful -->
            
            <div class="radio-survey-neutral">
               <input type="radio" name="surveyServiceUsefulness" id="surveyServiceNeutral" value="surveyServiceNeutral" required>
               <label for="surveyServiceNeutral">Neutral</label>
            </div> <!-- radio-survey-neutral -->

            <div class="radio-survey-useless">
               <input type="radio" name="surveyServiceUsefulness" id="surveyUseless" value="surveyUseless" required>
               <label for="surveyUseless">Useless</label>
            </div> <!-- radio-survey-useless -->

            <div class="radio-survey-extremely-useless">
               <input type="radio" name="surveyServiceUsefulness" id="surveyExtremelyUseless" value="surveyExtremelyUseless" required>
               <label for="surveyExtremelyUseless">ExtremelyUseless</label>
            </div> <!-- radio-survey-extremely-useless -->
         </div> <!-- survey-7 -->

         <!-- Survey8 -->
         <div class="survey-8 text-[#282222] text-[20px]">
            <h1 class="font-bold mb-[15px]">8. How do you recommend this website to your friends?</h1>

            <div class="radio-survey-very-recommend">
               <input type="radio" name="surveyRecommendWebsite" id="surveyVeryRecommend" value="surveyVeryRecommend" required>
               <label for="surveyVeryRecommend">Very Recommend</label>
            </div> <!-- radio-survey-very-recommend -->

            <div class="radio-survey-recommend">
               <input type="radio" name="surveyRecommendWebsite" id="surveyRecommend" value="surveyRecommend" required>
               <label for="surveyRecommend">Recommend</label>
            </div> <!-- radio-survey-recommend -->
            
            <div class="radio-survey-not-recommend">
               <input type="radio" name="surveyRecommendWebsite" id="surveyNotRecommend" value="surveyNotRecommend" required>
               <label for="surveyNotRecommend">Not Recommend</label>
            </div> <!-- radio-survey-not-recommend -->

            <div class="radio-survey-extremely-not-recommend">
               <input type="radio" name="surveyRecommendWebsite" id="surveyExtremelyNotRecommend" value="surveyExtremelyNotRecommend" required>
               <label for="surveyExtremelyNotRecommend">Extremely Not Recommend</label>
            </div> <!-- radio-survey-extremely-not-recommend -->
         </div> <!-- survey-8 -->

         <div class="rate-title text-[#282222] text-[36px] font-bold text-center">
            <h1>How do you rate us overall?</h1>
         </div> <!-- rate-title -->

         <div class="survey-rate flex flex-row justify-between">
            
            <div class="survey-reaction-style h-[122px] w-[122px] hover:scale-105 duration-700">
               <input type="radio" name="surveyReaction" value="sadReaction" id="sadReaction">
               <label for="sadReaction">
                  <img src="/images/SadEmoticon.png" alt="sadReaction">
               </label>
            </div>

            <div class="survey-reaction-style h-[122px] w-[122px] hover:scale-105 duration-700">
               <input type="radio" name="surveyReaction" value="neutralReaction" id="neutralReaction">
               <label for="neutralReaction">
                  <img src="/images/NeutralEmoticon.png" alt="neutralReaction">
               </label>
            </div>

            <div class="survey-reaction-style h-[122px] w-[122px] hover:scale-105 duration-700">
               <input type="radio" name="surveyReaction" value="happyReaction" id="happyReaction">
               <label for="happyReaction">
                  <img src="/images/HappyEmoticon.png" alt="happyReaction">
               </label>
            </div>
            
         </div> <!-- survey-rate -->

      </div> <!-- survey-question -->
         
      </form>

   </div> <!-- bg-survey -->

</main>

@include('components.footer')
@endsection