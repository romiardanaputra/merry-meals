<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Merry Meals | {{ $title }}</title>

</head>

<body>
    <section class="font-sans h-screen flex items-center justify-center">
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
    </section>
</body>

</html>