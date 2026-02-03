@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="bg-white rounded-[2.5rem] shadow-xl shadow-dark/5 border border-border/50 p-12 lg:p-16 animate-on-scroll">
    <form action="{{ route('admin.store') }}" class="space-y-12" method="POST">
        @csrf
        
        <!-- Personal Information Section -->
        <div class="space-y-8">
            <div class="flex items-center space-x-4 border-b border-border/30 pb-4">
                <div class="w-2 h-8 bg-primary rounded-full"></div>
                <h6 class="text-h6 text-dark tracking-tight">Personal Information</h6>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label for="fullName" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Full Name</label>
                    <input type="text" id="fullName" name="fullName" required value="{{ old('fullName') }}"
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="Enter full name">
                    @error('fullName') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="username" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Username</label>
                    <input type="text" id="username" name="username" required value="{{ old('username') }}"
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="Choose username">
                    @error('username') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label for="email" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Email Address</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="example@mail.com">
                    @error('email') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="phoneNumber" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" required value="{{ old('phoneNumber') }}"
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="+62 ...">
                    @error('phoneNumber') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label for="age" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Age (Years)</label>
                    <input type="number" id="age" name="age" required value="{{ old('age') }}"
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="e.g. 25">
                    @error('age') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="role" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">User Role</label>
                    <select id="role" name="role" required
                            class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark appearance-none cursor-pointer">
                        <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                        <option value="volunteer" {{ old('role') == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                        <option value="caregiver" {{ old('role') == 'caregiver' ? 'selected' : '' }}>Caregiver</option>
                        <option value="partner" {{ old('role') == 'partner' ? 'selected' : '' }}>Partner</option>
                    </select>
                    @error('role') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="address" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Living Address</label>
                <textarea id="address" name="address" required rows="3"
                          class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                          placeholder="Full street address">{{ old('address') }}</textarea>
                @error('address') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Security Section -->
        <div class="space-y-8 pt-6">
            <div class="flex items-center space-x-4 border-b border-border/30 pb-4">
                <div class="w-2 h-8 bg-accent rounded-full"></div>
                <h6 class="text-h6 text-dark tracking-tight">Security Credentials</h6>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-2">
                    <label for="password" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="••••••••">
                    @error('password') <p class="text-[10px] font-bold text-red-500 ml-1 italic">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-xs font-black uppercase tracking-widest text-dark/40 ml-1">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-6 py-4 bg-dark/5 border border-transparent rounded-2xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 font-bold text-dark placeholder:text-dark/20"
                           placeholder="••••••••">
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col md:flex-row items-center justify-end gap-6 pt-12 border-t border-border/30">
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center justify-center w-full md:w-auto px-10 py-4 bg-dark/5 text-dark font-black rounded-2xl hover:bg-dark hover:text-white transition-all duration-500 italic uppercase tracking-widest text-xs">
                Cancel
            </a>
            <button type="submit" 
                    class="w-full md:w-auto px-12 py-4 bg-primary text-dark font-black rounded-2xl hover:scale-105 transition-all duration-500 shadow-xl shadow-primary/20 uppercase tracking-widest text-xs">
                Create Account
            </button>
        </div>
    </form>
</div>
@endsection