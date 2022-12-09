@extends('admin.dashboard')
@section('dashboard_admin')
<div class="form-register-fields w-full pr-[5rem] mx-[10px]">
    <form action="{{ route('admin.update', $user->id) }}" class="flex flex-col space-y-[24px]" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-row space-x-[45px]">
            <div class="text-gray-500 w-1/2">
                <label for="fullName">Full Name*</label>
                <input type="text"
                    class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('fullName')@enderror"
                    name="fullName" required value="{{ old('fullName') ?? $user->fullName }}">
                @error('fullName')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->

            <div class="text-gray-500 w-1/2">
                <label for="username">Username*</label>
                <input type="text"
                    class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('username')@enderror"
                    name="username" required value="{{ old('username') ?? $user->username }}" readonly>
                @error('username')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->
        </div> <!-- form-register-flex -->

        <div class="flex flex-row space-x-[45px]">
            <div class="text-gray-500 w-1/2">
                <label for="email">Email*</label>
                <input type="email"
                    class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('email')@enderror" name="email"
                    required value="{{ old('email') ?? $user->email }}" readonly>
                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->

            <div class="text-gray-500 w-1/2">
                <label for="phoneNumber">Phone Number*</label>
                <input type="text"
                    class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('phoneNumber')@enderror"
                    name="phoneNumber" required value="{{ old('phoneNumber') ?? $user->phoneNumber }}" readonly>
                @error('phoneNumber')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->
        </div> <!-- form-register-flex -->

        <div class="flex flex-row space-x-[45px]">
            <div class="text-gray-500 w-1/2">
                <label for="age">Age (yr)*</label>
                <input type="number" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('age')@enderror"
                    name="age" required value="{{ old('age') ?? $user->age }}">
                @error('age')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->

            <div class="text-gray-500 w-1/2">
                <label for="role">role</label>
                <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('role')@enderror"
                    name="role" required value="{{ old('role') ?? $user->role }}" readonly>
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
                    name="address" required value="{{ old('address') ?? $user->address }}">
                @error('address')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->
        </div> <!-- form-register-flex -->

        <div class="flex flex-row space-x-[45px]">
            <div class="text-gray-500 w-1/2 hidden">
                <label for="password">Password*</label>
                <input type="password"
                    class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('password')@enderror"
                    name="password" required value="{{ old('password') ?? $user->password }}">
                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->

            <div class="text-gray-500 w-1/2 hidden">
                <label for="confirm_password">Confirm Password*</label>
                <input type="password"
                    class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('confirm_password')@enderror"
                    name='confirm_password' required value="{{ old('password') ?? $user->password }}">

                @error('confirm_password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div> <!-- text -->
        </div> <!-- form-register-flex -->

        <div class="flex justify-end">
            <a role="button" href="{{ route('admin.index') }}"
                    class="mt-[30px] mr-5 h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 flex justify-center items-center">
                    Cancel
                </a>
            <button type="submit"
                class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Save</button>
        </div> <!-- button-flex -->
    </form>
</div> <!-- form-register-fields -->
@endsection