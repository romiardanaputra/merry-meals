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
    <div class="bg-register h-fit w-full bg-[#FFFCF0] py-[138px] px-[147px]">
        <div style="box-shadow: 0px 8px 50px rgba(174, 168, 135, 0.5);" class="bg-form-register h-[789px] w-full bg-[#FFFCF0] p-[103px] flex flex-row justify-center items-center space-x-[108px]">

            <div class="form-register-text flex flex-col text-[#282222] w-[198px] space-y-[26px]">
                <h1 class="font-semibold text-[40px]">Welcome</h1>
                <p class="text-[16px] w-full text-justify break-words tracking-tighter">Create your account to be a member, volunteer, and caregiver</p>
                <a href=""><button class="w-full h-[37.53px] bg-[#A07C00] text-[#FFFCF0] text-[16px] hover:scale-105 duration-500">Login</button></a>
            </div> <!-- form-register-text -->

            <div class="form-register-fields w-full">
                <form action="/register" class="flex flex-col space-y-[24px]">        
                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="full-name">Full Name*</label>
                            <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                        
                        <div class="text-gray-500 w-1/2">
                            <label for="username">Username*</label>
                            <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="email">Email*</label>
                            <input type="email" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                        
                        <div class="text-gray-500 w-1/2">
                            <label for="phone-number">Phone Number*</label>
                            <input type="text" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="age">Age (yr)*</label>
                            <input type="number" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                        
                        <div class="text-gray-500 w-1/2">
                            <label for="role">Register as*</label>                            
                            <select class="w-full bg-[#FFFCF0] border border-gray-400 text-gray-500 py-2 px-3 pr-8 leading-tight focus:outline-none focus:bg-[#FFFCF0] focus:border-gray-500" id="role">
                                <option class="block">Please select your role</option>
                                <option>Member</option>
                                <option>Volunteer</option>
                                <option>Caregiver</option>
                            </select>                           

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-full">
                            <label for="address">Address*</label>
                            <input type="number" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex flex-row space-x-[45px]">
                        <div class="text-gray-500 w-1/2">
                            <label for="password">Password*</label>
                            <input type="password" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                        
                        <div class="text-gray-500 w-1/2">
                            <label for="confirm-password">Confirm Password*</label>
                            <input type="password" class="bg-[#FFFCF0] border border-gray-400 w-full py-2 px-3">

                            @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div> <!-- text -->
                    </div> <!-- form-register-flex -->

                    <div class="flex justify-end">
                        <button type="submit" class="mt-[30px] h-[35px] w-[180px] border-2 border-[#A07C00] bg-[#FFFCF0] font-medium text-[16px] text-[#A07C00] hover:scale-105 duration-500">Register</button>
                    </div> <!-- button-flex -->
                </form>
            </div> <!-- form-register-fields -->

        </div> <!-- bg-form-register -->
    </div> <!-- bg-register -->
    @include('components.footer')

    {{-- <section class="font-sans h-screen flex items-center justify-center">
        <div class="form-section container mx-auto">
            <div class="max-w-full h-full">
                <form action="/register" method="POST" class="shadow-lg w-1/2 rounded-lg m-auto">
                    <h1 class="text-5xl font-semibold uppercase leading-relaxed text-center pt-[2rem]">{{ $name_content
                        }}</h1>
                    @csrf
                    <div class="form-detail px-[10rem] py-[5rem] flex justify-center items-center flex-col">
                        <div class="mb-6 w-full block  ">
                            <input
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('first_name') @enderror"
                                id="first_name" name="first_name" type="text" required placeholder="Firstname">
                            @error('first_name')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block">
                            <input
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('last_name') @enderror"
                                id="last_name" name="last_name" type="text" required placeholder="Lastname">
                            @error('last_name')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block  ">
                            <input
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('username') @enderror"
                                id="username" name="username" type="text" required placeholder="Username">
                            @error('username')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block  ">
                            <input
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('email_user') @enderror"
                                id="email_user" name="email_user" type="text" required placeholder="Email Address">
                            @error('email_user')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block  ">
                            <input
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('password') @enderror"
                                id="password" name="password" type="password" required placeholder="Password">
                            @error('password')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block  ">
                            <input
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('phone_number') @enderror"
                                id="phone_number" name="phone_number" type="text" required placeholder="phone_number">
                            @error('phone_number')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6 w-full block  ">
                            <select class="select select-secondary w-full" name="role" id="role">
                                <option>member</option>
                                <option>caregiver</option>
                                <option>volunteer</option>
                            </select>
                        </div>
                        <div class="mb-6 w-full block  ">
                            <textarea
                                class="input input-bordered input-secondary w-full block px-6 py-6 @error('address') @enderror"
                                id="address" name="address" type="text" required
                                placeholder="address"></textarea>
                            @error('address')
                            <div class="text-red-600 block">
                                <p class="text-left">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <button
                            class="border border-orange-300 p-3 rounded-md text-orange-300 hover:text-white hover:bg-orange-300 w-full hover:transition duration-500 ease-in-out font-semibold"
                            type="submit">SIGN UP</button>
                        <span class="mt-[4rem]">Already Have An Account ? <a class="text-blue-500" href="/login">Sign In
                                Here !</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section> --}}
</body>

</html>
