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
@include('components.navbar')
</body>

</html>
