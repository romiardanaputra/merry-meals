<div class="space-y-4 animate-on-scroll">
    {{-- Header Row --}}
    <div class="hidden lg:grid grid-cols-12 px-8 py-3 bg-gray-50/50 rounded-xl mb-4">
        <div class="col-span-1 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">#</div>
        <div class="col-span-4 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">User Identity</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Contact Information</div>
        <div class="col-span-2 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Role</div>
        <div class="col-span-2 text-right text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Actions</div>
    </div>

    @foreach ($data_users as $user)
    <div class="bg-white rounded-2xl p-6 lg:p-0 lg:px-8 lg:py-4 flex flex-col lg:grid lg:grid-cols-12 items-center gap-4 lg:gap-0 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 group border border-transparent hover:border-primary/10">
        {{-- No --}}
        <div class="lg:col-span-1 hidden lg:block">
            <span class="text-xs font-black text-dark/20">{{ $loop->iteration }}</span>
        </div>

        {{-- User Identity --}}
        <div class="lg:col-span-4 w-full lg:w-auto">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                    <span class="text-primary font-black text-lg">{{ strtoupper(substr($user->name ?? $user->username, 0, 1)) }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-black text-dark tracking-tight">{{ $user->name ?? $user->username }}</span>
                    <span class="text-[10px] text-dark/40 font-bold uppercase tracking-widest">{{ $user->age ?? '??' }} Years Old</span>
                </div>
            </div>
        </div>

        {{-- Contact --}}
        <div class="lg:col-span-3 w-full lg:w-auto">
            <div class="flex flex-col">
                <span class="text-[11px] font-bold text-dark/60">{{ $user->email }}</span>
                <span class="text-[9px] text-primary font-black uppercase tracking-tight italic">{{ $user->username }}</span>
            </div>
        </div>

        {{-- Role --}}
        <div class="lg:col-span-2 w-full lg:w-auto">
            @php
                $roleColors = [
                    'superadmin' => 'bg-purple-100 text-purple-700 border-purple-200',
                    'admin' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'member' => 'bg-gray-100 text-gray-700 border-gray-200',
                    'partner' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'driver' => 'bg-green-100 text-green-700 border-green-200',
                ];
                $colorClass = $roleColors[$user->role] ?? 'bg-gray-100 text-gray-700 border-gray-200';
            @endphp
            <span class="px-4 py-1.5 {{ $colorClass }} text-[9px] font-black uppercase tracking-widest rounded-xl border">
                {{ $user->role }}
            </span>
        </div>

        {{-- Action --}}
        <div class="lg:col-span-2 w-full lg:w-auto">
            <div class="flex items-center lg:justify-end gap-2">
                <a href="{{ route('admin.edit', $user) }}" 
                    class="w-10 h-10 bg-blue-500/10 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-sm"
                    title="Update User">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-10 h-10 bg-red-500/10 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm"
                            onclick="return confirm('Are you sure you want to delete this user?')"
                            title="Delete User">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-8 px-4">
    {{ $data_users->links('partials.custom-pagination') }}
</div>

