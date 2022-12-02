@extends('admin.dashboard')
@section('dashboard_admin')
<main class="font-poppins">
    <div class="form-register-fields w-full">
        <form action="{{ route('meal.update', $meal->id) }}" class="flex flex-col space-y-[24px]" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="name">Meal Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('name')@enderror" name="name"
                        required value="{{ old('name ') ?? $meal->name }}">

                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="ingredient">ingredient*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('ingredient')@enderror"
                        name="ingredient" required value="{{ old('ingredient') ?? $meal->ingredient }}">

                    @error('ingredient')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="path">image*</label>
                    <input type="file"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('path')@enderror" name="path"
                        required value="{{ old('path') }}">

                    @error('path')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex justify-end">
                <button type="submit"
                    class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Submit</button>
            </div> <!-- button-flex -->
        </form>
    </div> <!-- form-register-fields -->
</main>
@endsection