{{-- Superadmin Profile Edit View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-black text-[#222222] tracking-tight">My Profile</h1>
        <p class="text-sm text-gray-500 mt-1">Manage your account settings</p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Profile Info --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h3 class="text-lg font-bold text-[#222222] mb-6">Profile Information</h3>
            <form action="{{ route('superadmin.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('username') border-red-300 @enderror">
                    @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('email') border-red-300 @enderror">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-[#FF7B54] text-white rounded-xl font-bold hover:bg-[#FF7B54]/90 transition-all shadow-lg shadow-[#FF7B54]/20">
                    Update Profile
                </button>
            </form>
        </div>

        {{-- Password Change --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h3 class="text-lg font-bold text-[#222222] mb-6">Change Password</h3>
            <form action="{{ route('superadmin.profile.password') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div>
                    <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('current_password') border-red-300 @enderror">
                    @error('current_password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('password') border-red-300 @enderror">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-[#222222] text-white rounded-xl font-bold hover:bg-[#222222]/90 transition-all">
                    Update Password
                </button>
            </form>
        </div>
    </div>
@endsection
