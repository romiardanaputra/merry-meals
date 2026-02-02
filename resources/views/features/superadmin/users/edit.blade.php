{{-- Superadmin Users Edit View --}}
@extends('layouts.dashboard.base')

@section('dashboard_content')
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('superadmin.users.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#222222] transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Users
        </a>
        <h1 class="text-2xl font-black text-[#222222] tracking-tight">Edit User</h1>
        <p class="text-sm text-gray-500 mt-1">Update user information for {{ $user->name ?? $user->username }}</p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('superadmin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('username') border-red-300 @enderror">
                    @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('email') border-red-300 @enderror">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm font-bold text-gray-700 mb-2">Role</label>
                    <select name="role" id="role" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('role') border-red-300 @enderror">
                        <option value="member" {{ old('role', $user->role) === 'member' ? 'selected' : '' }}>Member</option>
                        <option value="driver" {{ old('role', $user->role) === 'driver' ? 'selected' : '' }}>Driver</option>
                        <option value="partner" {{ old('role', $user->role) === 'partner' ? 'selected' : '' }}>Partner</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ old('role', $user->role) === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password (Optional) --}}
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">New Password <span class="text-gray-400 font-normal">(leave blank to keep current)</span></label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all @error('password') border-red-300 @enderror">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF7B54] focus:border-transparent transition-all">
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                <a href="{{ route('superadmin.users.index') }}" 
                   class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-[#FF7B54] text-white rounded-xl font-bold hover:bg-[#FF7B54]/90 transition-all shadow-lg shadow-[#FF7B54]/20">
                    Update User
                </button>
            </div>
        </form>
    </div>
@endsection
