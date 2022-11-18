<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Merry Meals | {{ $title }}</title>

</head>

<body class="font-poppins">
@include('components.navbar')
    <div class="bg-login h-fit w-full bg-[#FFFCF0] py-[138px] px-[147px]">
        <div style="box-shadow: 0px 8px 50px rgba(174, 168, 135, 0.5);" class="bg-form-login h-[789px] w-full bg-[#FFFCF0] px-[86px] py-[169px] flex flex-row justify-center items-center space-x-[108px]">

            <div class="form-login-text text-center text-[#282222] w-[70%]">
                <h1 class="font-semibold text-[40px]">Welcome back!</h1>
                <p class="text-[16px] mt-[-10px]">You can sign in with existing account</p>
            </div> <!-- form-login-text -->

            <div class="form-login-fields h-fit w-full">
                <form action="/login">        
                    <div class="flex flex-col space-y-[24px] mb-[60px]">
                        <div class="text-gray-500 w-full">
                            <label for="email">Email*</label>
                            <input type="email" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                        
                        <div class="text-gray-500 w-full">
                            <label for="password">Password*</label>
                            <input type="password" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex justify-center">
                        <button type="submit" class="mt-[30px] h-[35px] w-[145.08px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500 mb-[29px]">Login</button>
                    </div> <!-- button-flex -->

                    <div class="link-register flex flex-row font-medium text-[16px] space-x-[5px] justify-center">
                        <h2 class="text-[#282222]">Don't have an account?</h2>
                        <a href="/register" class="text-[#A07C00] hover:scale-105 duration-500">Create an Account</a>
                    </div> <!-- link-register -->
                </form>
            </div> <!-- form-login-fields -->

        </div> <!-- bg-form-login -->
    </div> <!-- bg-login -->
@include('components.footer')
    <!-- <section class="font-sans h-screen flex items-center justify-center">
        <div class="form-section container mx-auto">
            @if (session()->has('success'))
            <div class="alert alert-success shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if (session()->has('login_error'))
            <div class="alert alert-error shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('login_error') }}</span>
                </div>
            </div>
            @endif

            <div class="max-w-full h-full">
                <form action="/login" method="POST" class="shadow-lg w-1/2 rounded-lg m-auto">
                    @csrf
                    <h1 class="text-5xl font-semibold uppercase leading-relaxed text-center pt-[2rem]">{{ $name_content
                        }}</h1>
                    <div class="form-detail px-[10rem] py-[5rem] flex justify-center items-center flex-col">
                        <div class="mb-6 w-full block  ">
                            <input class="input input-bordered input-secondary w-full block px-6 py-6 @error('email_user') @enderror"
                                id="email_user" name="email_user" type="text" required placeholder="Email Address">
                            @error('email_user')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block  ">
                            <input class="input input-bordered input-secondary w-full block px-6 py-6 @error('password') @enderror"
                                id="password" name="password" type="password" required placeholder="Password">
                            @error('password')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <button
                            class="border border-orange-300 p-3 rounded-md text-orange-300 hover:text-white hover:bg-orange-300 w-full hover:transition duration-500 ease-in-out font-semibold"
                            type="submit">SIGN IN</button>
                        <span class="mt-[4rem]">Don't Have An Account ? <a class="text-blue-500" href="/register">Sign
                                Up Here !</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section> -->
</body>

</html>