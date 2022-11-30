@extends('layout.main')
@section('component_content')
<main class="font-poppins">
    @include('components.navbar')
    <div class="bg-register h-fit w-full bg-[#FFFCF0] py-[138px] px-[147px]">
        <div style="box-shadow: 0px 8px 50px rgba(174, 168, 135, 0.5);"
            class="bg-form-register h-[789px] w-full bg-[#FFFCF0] p-[103px] flex flex-row justify-center items-center space-x-[108px]">

            <div class="form-register-text flex flex-col text-[#282222] w-[198px] space-y-[26px]">
                <h1 class="font-semibold text-[40px]">Welcome</h1>
                <p class="text-[16px] w-full text-justify break-words tracking-tighter">Create your account to be a
                    member, volunteer, and caregiver</p>
                <a href="{{ route('login') }}"><button
                        class="w-full h-[37.53px] bg-[#A07C00] text-[#FFFCF0] text-[16px] hover:scale-105 duration-500">Login</button></a>
            </div> <!-- form-register-text -->

            <div class="form-register-fields w-full">
                <form action="{{ route('meal.store') }}" class="flex flex-col space-y-[24px]" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="name">Full Name*</label>
                            <input type="text"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('name')@enderror"
                                name="name" required value="{{ old('name ') }}">

                            @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->

                        <div class="text-gray-500 w-1/2">
                            <label for="ingredient">ingredient*</label>
                            <input type="text"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('ingredient')@enderror"
                                name="ingredient" required>

                            @error('ingredient')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->

                        <div class="text-gray-500 w-1/2">
                            <label for="path">image*</label>
                            <input type="file"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('path')@enderror"
                                name="path" required>

                            @error('path')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex justify-end">
                        <button type="submit"
                            class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Register</button>
                    </div> <!-- button-flex -->
                </form>
            </div> <!-- form-register-fields -->

        </div> <!-- bg-form-register -->
    </div> <!-- bg-register -->
    @include('components.footer')
</main>
@endsection