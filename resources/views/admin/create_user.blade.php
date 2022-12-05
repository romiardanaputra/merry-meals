@extends('admin.dashboard')
@section('dashboard_admin')
<main class="font-poppins">
    <div class="form-register-fields w-full pr-[5rem] mx-[10px]">
        <form action="{{ route('admin.store') }}" class="flex flex-col space-y-[24px]" method="POST">
            @csrf
            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="fullName">Full Name*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('fullName')@enderror"
                        name="fullName" required value="{{ old('fullName') }}">

                    @error('fullName')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="username">Username*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('username')@enderror"
                        name="username" required value="{{ old('username') }}">

                    @error('username')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="email">Email*</label>
                    <input type="email"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('email')@enderror"
                        name="email" required value="{{ old('email') }}">

                    @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="phoneNumber">Phone Number*</label>
                    <input type="text"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('phoneNumber')@enderror"
                        name="phoneNumber" required value="{{ old('phoneNumber') }}">

                    @error('phoneNumber')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="age">Age (yr)*</label>
                    <input type="number"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('age')@enderror" name="age"
                        required value="{{ old('age') }}">

                    @error('age')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="role">Register as*</label>
                    <select
                        class="w-full bg-[#FFFCF0] border border-gray-400 text-gray-500 py-2 px-3 input pr-8 leading-tight focus:outline-none focus:bg-[#FFFCF0] focus:border-gray-500 @error('role')@enderror"
                        id="role" name="role" required value="{{ old('role') }}" >
                        <option>member</option>
                        <option>volunteer</option>
                        <option>caregiver</option>
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
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('address')@enderror"
                        name="address" required value="{{ old('address') }}">

                    @error('address')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex flex-row space-x-[45px]">
                <div class="text-gray-500 w-1/2">
                    <label for="password">Password*</label>
                    <input type="password"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('password')@enderror"
                        name="password" required value="{{ old('password') }}">

                    @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->

                <div class="text-gray-500 w-1/2">
                    <label for="confirmPassword">Confirm Password*</label>
                    <input type="password"
                        class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('confirmPassword')@enderror"
                        name='confirmPassword' required value="{{ old('confirmPassword') }}">

                    @error('confirmPassword')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div> <!-- text -->
            </div> <!-- form-register-flex -->

            <div class="flex justify-end">
                <a role="button" href="{{ route('admin.index') }}"
                    class="mt-[30px] mr-5 h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 flex justify-center items-center">
                    Back
                </a>
                <button type="submit"
                    class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Create User</button>
            </div> <!-- button-flex -->
        </form>
    </div> <!-- form-register-fields -->
</main>
@endsection