<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/50 overflow-hidden animate-on-scroll">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark/5 border-b border-border/50">
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">No</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Fullname</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Username</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">E-mail</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Role</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/30">
                @foreach ($data_users as $user)
                <tr class="hover:bg-primary/5 transition-colors duration-300">
                    <td class="px-8 py-6 text-p font-bold text-dark/40">{{ $loop->iteration }}</td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-p font-bold text-dark tracking-tight">{{ $user->fullName }}</span>
                            <span class="text-xs text-dark/40 font-medium uppercase tracking-widest">{{ $user->age }} Years Old</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-p font-medium text-dark/60">{{ $user->username }}</td>
                    <td class="px-8 py-6 text-p font-medium text-dark/60 italic underline decoration-primary/30">{{ $user->email }}</td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest rounded-full border border-primary/20">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.edit', $user) }}" 
                               class="p-2 bg-green-500/10 text-green-600 rounded-lg hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm"
                               title="Update User">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 bg-red-500/10 text-red-600 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm"
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        title="Delete User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
