@extends('partner.dashboard')
@section('partnerContent')
<main class="font-poppins">
    <div class="form-register-fields w-full pr-[5rem] mx-[10px]">
        <form action="{{ route('partnerProfile.edit', $partner) }}" class="flex flex-col space-y-[24px]" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="ownerName">Owner Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('ownerName')@enderror"
                        name="ownerName" required value="{{ old('ownerName') ?? $partner->ownerName }}">
                    @error('ownerName')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="restaurantName">Restaurant Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('restaurantName')@enderror"
                        name="restaurantName" required value="{{ old('restaurantName') ?? $partner->restaurantName }}">
                    @error('restaurantName')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="restaurantContact">Restaurant Contact*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('restaurantContact')@enderror"
                        name="restaurantContact" required value="{{ old('restaurantContact') ?? $partner->restaurantContact}}">
                    @error('restaurantContact')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="restaurantImage">Restaurant Image*</label>
                    <input type="file"
                        class="bg-[#FFFCF0] border border-gray-400 w-full file-input @error('restaurantImage')@enderror"
                        name="restaurantImage" required value="{{ old('restaurantImage') ?? $partner->restaurantImage }}">
                    @error('restaurantImage')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="restaurantAddress">Restaurant Address*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('restaurantAddress')@enderror"
                        name="restaurantAddress" required value="{{ old('restaurantAddress') ?? $partner->restaurantAddress }}">
                    @error('restaurantAddress')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
                <div class="text-gray-500 w-1/2">
                    <label for="foodType">Food Type*</label>
                    <select
                        class="w-full bg-[#FFFCF0] border border-gray-400 text-gray-500 py-2 px-3 input pr-8 leading-tight focus:outline-none focus:bg-[#FFFCF0] focus:border-gray-500 @error('foodType')@enderror"
                        id="foodType" name="foodType" required value="{{ old('foodType') ??$partner->foodType  }}">
                        <option>vegan friendly</option>
                        <option>non vegan friendly</option>
                    </select>
                    @error('foodType')
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
