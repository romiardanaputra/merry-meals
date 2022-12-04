@extends('admin.dashboard')
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
                <form action="{{ route('user.store') }}" class="flex flex-col space-y-[24px]" method="POST">
                    @csrf
                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="fullName">Full Name*</label>
                            <input type="text"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('fullName')@enderror"
                                name="fullName" required value="{{ old('fullName ') }}">

                            @error('fullName')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->

                        <div class="text-gray-500 w-1/2">
                            <label for="username">Username*</label>
                            <input type="text"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('username')@enderror"
                                name="username" required value="{{ old('username ') }}">

                            @error('username')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="email">Email*</label>
                            <input type="email"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('email')@enderror"
                                name="email" required value="{{ old('email ') }}">

                            @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->

                        <div class="text-gray-500 w-1/2">
                            <label for="phoneNumber">Phone Number*</label>
                            <input type="text"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('phoneNumber')@enderror"
                                name="phoneNumber" required value="{{ old('phoneNumber ') }}">

                            @error('phoneNumber')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="age">Age (yr)*</label>
                            <input type="number"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('age')@enderror"
                                name="age" required value="{{ old('age ') }}">

                            @error('age')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->

                        <div class="text-gray-500 w-1/2">
                            <label for="role">Register as*</label>
                            <select
                                class="w-full bg-[#FFFCF0] border border-gray-400 text-gray-500 py-2 px-3 pr-8 leading-tight focus:outline-none focus:bg-[#FFFCF0] focus:border-gray-500 @error('role')@enderror"
                                id="role" name="role" required value="{{ old('role ') }}">
                                <option class="block disabled">Please select your role</option>
                                <option>Member</option>
                                <option>Volunteer</option>
                                <option>Caregiver</option>
                            </select>

                            @error('role')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-full">
                            <label for="address">Address*</label>
                            <input type="text"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('address')@enderror"
                                name="address" required value="{{ old('address ') }}">

                            @error('address')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="password">Password*</label>
                            <input type="password"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('password')@enderror"
                                name="password" required value="{{ old('password ') }}">

                            @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->

                        <div class="text-gray-500 w-1/2">
                            <label for="confirmPassword">Confirm Password*</label>
                            <input type="password"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 @error('confirmPassword')@enderror"
                                name='confirmPassword' required value="{{ old('confirmPassword ') }}">

                            @error('confirmPassword')
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