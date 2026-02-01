@extends('layouts.main')

@section('css_custom')
    @vite(['resources/css/docs.css'])
    <style>
        .text-h2 { font-size: calc(1.5rem + 1.5vw); font-weight: 900; line-height: 1.1; letter-spacing: -0.05em; }
        .text-h4 { font-size: 1.953rem; font-weight: 800; line-height: 1.2; }
    </style>
@endsection

@section('component_content')
<main class="min-h-screen bg-[#F8F8F8] font-inter p-4 sm:p-8 lg:p-12 overflow-x-hidden">
    <!-- Header (Consistent with Member Suite) -->
    <header class="max-w-[1200px] mx-auto flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-16 px-2">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm p-2">
                <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-xl font-black tracking-tight text-dark uppercase leading-none">Account Settings</h1>
                <p class="text-[9px] font-bold text-primary tracking-widest uppercase mt-1">Manage your profile</p>
            </div>
        </div>

        <nav x-data="{ 
                activeIndex: 3,
                get sliderStyle() {
                    const el = this.$refs['navItem' + this.activeIndex];
                    if (!el) return '';
                    return `left: ${el.offsetLeft}px; width: ${el.offsetWidth}px;`;
                }
             }" 
             class="hidden lg:flex items-center bg-white p-1.5 rounded-full shadow-sm border border-black/5 relative overflow-hidden h-12">
            
            <div class="absolute top-1.5 bottom-1.5 bg-dark rounded-full shadow-lg shadow-dark/20 transition-all duration-500 ease-out z-0" 
                 :style="sliderStyle"></div>
            
            <div class="flex items-center space-x-1 min-w-max px-1">
                @php
                    $navLinks = [
                        ['route' => 'member.dashboard', 'label' => 'Overview', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'meal.menu', 'label' => 'Browse Menu', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['route' => 'member.survey', 'label' => 'Feedback', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ];
                @endphp

                @foreach($navLinks as $index => $link)
                    <a href="{{ route($link['route']) }}" 
                       x-ref="navItem{{ $index }}"
                       class="flex items-center space-x-2 px-6 py-2 rounded-full font-black text-[11px] uppercase tracking-wider transition-all duration-500 whitespace-nowrap relative z-10 
                       {{ Request::routeIs($link['route']) ? 'text-white' : 'text-dark/40 hover:text-dark' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $link['icon'] }}" /></svg>
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </nav>
    </header>

    <div class="max-w-[1000px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Sidebar Navigation (Links within Profile) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-[2rem] p-8 border border-black/5 shadow-sm text-center">
                <div class="w-24 h-24 bg-primary mx-auto rounded-full flex items-center justify-center text-4xl font-black text-dark mb-4 shadow-xl shadow-primary/20">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h3 class="text-xl font-black text-dark tracking-tighter">{{ $user->name }}</h3>
                <p class="text-xs font-bold text-dark/40 uppercase tracking-widest mt-1">Member</p>
            </div>

            <div class="space-y-2">
                <a href="#profile-info" class="flex items-center w-full p-4 bg-white rounded-2xl border border-black/5 font-bold text-xs uppercase tracking-widest text-dark hover:bg-dark hover:text-white transition-all group">
                    <svg class="w-4 h-4 mr-3 text-dark/40 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Public Info
                </a>
                <a href="#password" class="flex items-center w-full p-4 bg-white rounded-2xl border border-black/5 font-bold text-xs uppercase tracking-widest text-dark hover:bg-dark hover:text-white transition-all group">
                    <svg class="w-4 h-4 mr-3 text-dark/40 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Password
                </a>
                <a href="#delete" class="flex items-center w-full p-4 bg-white rounded-2xl border border-black/5 font-bold text-xs uppercase tracking-widest text-red-500 hover:bg-red-500 hover:text-white transition-all group">
                    <svg class="w-4 h-4 mr-3 text-red-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    Danger Zone
                </a>
            </div>
        </div>

        <!-- Forms -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Update Profile Information -->
            <section id="profile-info" class="bg-white rounded-[2.5rem] p-10 border border-black/5 shadow-sm">
                <div class="mb-8">
                    <h4 class="text-2xl font-black text-dark tracking-tighter">Profile Information</h4>
                    <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Update your account's profile information and email address.</p>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="space-y-2">
                        <label for="name" class="text-[10px] font-black uppercase tracking-widest text-dark">Name</label>
                        <input id="name" name="name" type="text" class="w-full p-4 bg-dark/5 border-none rounded-xl font-bold text-dark focus:ring-2 focus:ring-dark/20" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        <x-form.input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-[10px] font-black uppercase tracking-widest text-dark">Email</label>
                        <input id="email" name="email" type="email" class="w-full p-4 bg-dark/5 border-none rounded-xl font-bold text-dark focus:ring-2 focus:ring-dark/20" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        <x-form.input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-4 p-4 bg-yellow-50 rounded-xl">
                                <p class="text-sm text-yellow-800">
                                    {{ __('Your email address is unverified.') }}
                                    <button form="send-verification" class="underline hover:text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-sm font-medium text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-8 py-3 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-lg shadow-dark/10">Save Changes</button>
                        
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>

            <!-- Update Password -->
            <section id="password" class="bg-white rounded-[2.5rem] p-10 border border-black/5 shadow-sm">
                <div class="mb-8">
                    <h4 class="text-2xl font-black text-dark tracking-tighter">Update Password</h4>
                    <p class="text-[10px] font-bold text-dark/40 uppercase tracking-widest mt-1">Ensure your account is using a long, random password to stay secure.</p>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div class="space-y-2">
                        <label for="current_password" class="text-[10px] font-black uppercase tracking-widest text-dark">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="w-full p-4 bg-dark/5 border-none rounded-xl font-bold text-dark focus:ring-2 focus:ring-dark/20" autocomplete="current-password" />
                        <x-form.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-[10px] font-black uppercase tracking-widest text-dark">New Password</label>
                        <input id="password" name="password" type="password" class="w-full p-4 bg-dark/5 border-none rounded-xl font-bold text-dark focus:ring-2 focus:ring-dark/20" autocomplete="new-password" />
                        <x-form.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-[10px] font-black uppercase tracking-widest text-dark">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full p-4 bg-dark/5 border-none rounded-xl font-bold text-dark focus:ring-2 focus:ring-dark/20" autocomplete="new-password" />
                        <x-form.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-8 py-3 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-lg shadow-dark/10">Update Password</button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>

            <!-- Delete Account -->
            <section id="delete" class="bg-red-50 rounded-[2.5rem] p-10 border border-red-100 shadow-sm">
                <div class="mb-8">
                    <h4 class="text-2xl font-black text-red-900 tracking-tighter">Delete Account</h4>
                    <p class="text-[10px] font-bold text-red-800/60 uppercase tracking-widest mt-1">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = true" class="px-8 py-3 bg-red-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-red-700 hover:scale-105 transition-all shadow-lg shadow-red-600/20">
                        Delete Account
                    </button>

                    <!-- Modal -->
                    <div x-show="open" 
                         className="fixed inset-0 z-50 overflow-y-auto" 
                         style="display: none;"
                         role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-dark/50 backdrop-blur-sm transition-opacity" @click="open = false"></div>

                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-8">
                                <h2 class="text-lg font-black text-dark">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>

                                <p class="mt-4 text-sm text-dark/60">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('delete')

                                    <div class="space-y-2">
                                        <label for="password" class="sr-only">{{ __('Password') }}</label>
                                        <input id="password" name="password" type="password" class="w-full p-4 bg-dark/5 border-none rounded-xl font-bold text-dark focus:ring-2 focus:ring-red-500/20" placeholder="{{ __('Password') }}" />
                                        <x-form.input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="flex justify-end gap-3">
                                        <button type="button" @click="open = false" class="px-6 py-3 bg-gray-100 text-dark rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-gray-200">
                                            {{ __('Cancel') }}
                                        </button>
                                        <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-red-700">
                                            {{ __('Delete Account') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
