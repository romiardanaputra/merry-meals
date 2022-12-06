@extends('layout.main')
@section('component_content')
<main class="font-poppins">
    @include('components.navbar')
    <div class="bg-login h-fit w-full bg-[#FFFCF0] py-[138px] px-[147px]">
        <div style="box-shadow: 0px 8px 50px rgba(174, 168, 135, 0.5);"
            class="bg-form-login h-[789px] w-full bg-[#FFFCF0] px-[86px] py-[169px] flex flex-row justify-center items-center space-x-[108px]">
            <div class="form-login-text text-center text-[#282222] w-[70%]">
                <h1 class="font-semibold text-[40px]">Welcome back!</h1>
                <p class="text-[16px] mt-[-10px]">You can sign in with existing account</p>
            </div> <!-- form-login-text -->
            <div class="form-login-fields h-fit w-full">
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    {{--authentication allert success --}}
                    @if (session()->has('success'))
                    <div class="alert alert-success shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif
                    {{--authentication allert failed --}}
                    @if (session()->has('login_error'))
                    <div class="alert alert-error shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('login_error') }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="flex flex-col space-y-[24px] mb-[60px]">
                        <div class="text-gray-500 w-full">
                            <label for="email">Email*</label>
                            <input type="email"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('email')@enderror"
                                name="email" required>
                            @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                        <div class="text-gray-500 w-full">
                            <label for="password">Password*</label>
                            <input type="password"
                                class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3 input @error('email')@enderror"
                                name="password" required>
                            @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="mt-[30px] h-[35px] w-[145.08px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 mb-[29px] input flex justify-center items-center py-5">Login</button>
                    </div> <!-- button-flex -->
                    <div class="link-register flex flex-row font-medium text-[16px] space-x-[5px] justify-center">
                        <h2 class="text-[#282222]">Don't have an account?</h2>
                        <a href="/register" class="text-[#A07C00] hover:scale-105 duration-500 ">Create an Account</a>
                    </div> <!-- link-register -->
                </form>
            </div> <!-- form-login-fields -->
        </div> <!-- bg-form-login -->
    </div> <!-- bg-login -->
    @include('components.footer')
</main>
@endsection