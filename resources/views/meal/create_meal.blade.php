@extends('admin.dashboard')
@section('dashboard_admin')
<main class="font-poppins">
    <div class="form-register-fields w-full">
        <form action="{{ route('meal.store') }}" class="flex flex-col space-y-[24px]" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="name">Meal Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('name')@enderror"
                        name="name" required value="{{ old('name ') }}">

                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="ingredient">Meal Ingredient*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input input-bordered @error('ingredient')@enderror"
                        name="ingredient" required>

                    @error('ingredient')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="path">Meal Image*</label>
                    <input type="file"
                        class="file-input file-input-bordered bg-[#FFFCF0] border border-gray-400 w-full @error('path')@enderror"
                        name="path" required>

                    @error('path')
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
    </div> <!-- bg-form-register -->
    </div> <!-- bg-register -->

</main>
@endsection