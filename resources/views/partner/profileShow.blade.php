@extends('partner.dashboard')
@section('partnerContent')
<main class="font-poppins">
    <div class="form-register-fields w-full pr-[5rem] mx-[10px]">
        <form action="{{ route('partnerProfile.edit') }}" class="flex flex-col space-y-[24px]" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="ownerName">Owner Name*</label>
                    <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input"
                        name="ownerName" required value="{{ old('ownerName') ?? $partner->ownerName }}" readonly>
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="restaurantName">Restaurant Name*</label>
                    <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input"
                        name="restaurantName" required value="{{ old('restaurantName') ?? $partner->restaurantName }}"
                        readonly>
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="restaurantContact">Restaurant Contact*</label>
                    <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input"
                        name="restaurantContact" required
                        value="{{ old('restaurantContact') ?? $partner->restaurantContact}}" readonly>
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="restaurantImage">Restaurant Image*</label>
                    <img class="h-[120x] w-[120px] object-fill m-auto"
                        src="{{ asset('storage/'.$partner->restaurantImage)  }}" alt="restaurant-image">
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="restaurantAddress">Restaurant Address*</label>
                    <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input"
                        name="restaurantAddress" required
                        value="{{ old('restaurantAddress') $partner->restaurantAddress }}" readonly>
                </div> <!-- text -->
                <div class="text-gray-500 w-1/2">
                    <label for="foodType">Food Type*</label>
                    <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input"
                        name="foodType" required value="{{ old('foodType') $partner->foodType }}" readonly>
                </div>
            </div>
            <div class="flex justify-end">
                <a role="button" href="{{ route('profile.index') }}"
                    class="mt-[30px] mr-5 h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 flex justify-center items-center">
                    Back
                </a>
            </div> <!-- button-flex -->
        </form>
    </div> <!-- form-register-fields -->
</main>
@endsection