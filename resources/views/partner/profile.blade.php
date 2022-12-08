@extends('partner.dashboard')
@section('partnerContent')
<main class="font-poppins">
    <div class="form-register-fields w-full pr-[5rem] mx-[10px]">
        <form action="{{ route('partner.store') }}" class="flex flex-col space-y-[24px]" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="owner_name">Owner Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('owner_name')@enderror"
                        name="owner_name" required value="{{ old('owner_name') }}">
                    @error('owner_name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="restaurant_name">Restaurant Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('restaurant_name')@enderror"
                        name="restaurant_name" required value="{{ old('restaurant_name') }}">
                    @error('restaurant_name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="restaurant_contact">Restaurant Contact*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('restaurant_contact')@enderror"
                        name="restaurant_contact" required value="{{ old('restaurant_contact') }}">
                    @error('contact')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="restaurant_image">Restaurant Image*</label>
                    <input type="file"
                        class="bg-[#FFFCF0] border border-gray-400 w-full file-input @error('restaurant_image')@enderror"
                        name="restaurant_image" required value="{{ old('restaurant_image') }}">
                    @error('restaurant_image')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="restaurant_address">Restaurant Address*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('restaurant_address')@enderror"
                        name="restaurant_address" required value="{{ old('restaurant_address') }}">
                    @error('restaurant_address')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
                <div class="text-gray-500 w-1/2">
                    <label for="food_type">Food Type*</label>
                    <select
                        class="w-full bg-[#FFFCF0] border border-gray-400 text-gray-500 py-2 px-3 input pr-8 leading-tight focus:outline-none focus:bg-[#FFFCF0] focus:border-gray-500 @error('food_type')@enderror"
                        id="food_type" name="food_type" required value="{{ old('food_type') }}">
                        <option>vegan friendly</option>
                        <option>non vegan friendly</option>
                    </select>
                    @error('food_type')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror<!-- text -->
                </div>
            </div>
            <div class="flex justify-end">
                <a role="button" href="{{ route('partner_handler.index') }}"
                    class="mt-[30px] mr-5 h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 flex justify-center items-center">
                    Back
                </a>
                <button type="submit"
                    class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Create
                    Partner</button>
            </div> <!-- button-flex -->
        </form>
    </div> <!-- form-register-fields -->
</main>
@endsection