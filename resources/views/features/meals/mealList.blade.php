@extends(auth()->user()->role === 'admin' ? 'features.admin.dashboard' : 'partner.dashboard')

@section(auth()->user()->role === 'admin' ? 'dashboard_admin' : 'partnerContent')
<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/40 overflow-hidden">
    <div class="p-8 border-b border-border/40 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-dark tracking-tight">Meal Inventory</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-widest mt-1">Manage Available Menu and Availability</p>
        </div>
        @if(auth()->user()->role === 'partner')
        <a href="{{ route('meal.create') }}" class="inline-flex items-center px-6 py-3 bg-dark text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-dark/10 hover:scale-105 active:scale-95 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
            Add New Meal
        </a>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark/[0.02]">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Meal</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Ingredients</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Details</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/40">
                @forelse ($meals as $meal)
                <tr class="hover:bg-dark/[0.01] transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-xl bg-dark/5 flex items-center justify-center overflow-hidden border border-black/5">
                                @if($meal->mealImage)
                                    <img src="{{ asset('storage/'.$meal->mealImage) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-dark/10 text-xl font-black">{{ substr($meal->mealName, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-black text-dark leading-snug">{{ $meal->mealName }}</p>
                                <span class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-black uppercase rounded tracking-tighter">
                                    {{ $meal->mealType }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-[11px] font-bold text-dark/60 leading-relaxed max-w-[200px] line-clamp-2">
                            {{ $meal->mealIngredient }}
                        </p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-[11px] font-medium text-dark/40 italic leading-relaxed max-w-[250px] line-clamp-2">
                            "{{ $meal->mealDescription }}"
                        </p>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $isAvailable = $meal->mealAvailability === 'available';
                            $statusColor = $isAvailable ? 'bg-green-500/10 text-green-600' : 'bg-red-500/10 text-red-600';
                        @endphp
                        <span class="px-3 py-1.5 {{ $statusColor }} text-[10px] font-black uppercase rounded-lg tracking-widest">
                            {{ $meal->mealAvailability }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('meal.edit', $meal->id) }}" class="p-2 text-dark/40 hover:text-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            <form action="{{ route('meal.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Silahkan konfirmasi penghapusan menu ini.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-dark/20 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-dark/20 font-black uppercase text-sm tracking-widest italic">No meals in inventory</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
