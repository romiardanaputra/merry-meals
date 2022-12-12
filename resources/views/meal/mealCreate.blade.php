@extends('partner.dashboard')
@section('partnerContent')
<main class="font-poppins">
    <div class="form-register-fields w-full">
        <form action="{{ route('meal.store') }}" class="flex flex-col space-y-[24px]" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="mealName">Meal Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('mealName')@enderror"
                        name="mealName" required value="{{ old('mealName') }}">

                    @error('mealName')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
                <div class="text-gray-500 w-1/2">
                    <label for="mealType">Meal Type*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('mealType')@enderror"
                        name="mealType" required value="{{ old('mealType') }}">

                    @error('mealType')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="mealIngredient">Meal Ingredient*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('mealIngredient')@enderror"
                        name="mealIngredient" required value="{{ old('mealIngredient') }}">

                    @error('mealIngredient')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
                <div class="text-gray-500 w-1/2">
                    <label for="mealDescription">Meal Description*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('mealDescription')@enderror"
                        name="mealDescription" required value="{{ old('mealDescription') }}">

                    @error('mealDescription')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="mealAvailability">Meal Available*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('mealAvailability')@enderror"
                        name="mealAvailability" required value="{{ old('mealAvailability') }}">

                    @error('mealAvailability')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="mealImage">Meal Image*</label>
                    <input type="file"
                        class="file-input file-input-bordered bg-[#FFFCF0] border border-gray-400 w-full @error('mealImage')@enderror"
                        name="mealImage" required value="{{ old('mealImage') }}">

                    @error('mealImage')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex justify-end">
                <a role="button" href="{{ route('meal.index') }}"
                    class="mt-[30px] mr-5 h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 flex justify-center items-center">
                    Back
                </a>
                <button type="submit"
                    class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Create</button>
            </div> <!-- button-flex -->
        </form>
    </div> <!-- form-register-fields -->
</main>
@endsection