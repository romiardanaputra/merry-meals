<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/50 overflow-hidden animate-on-scroll">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark/[0.02]">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">No</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Donator Name</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Amount</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">E-mail</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Contact</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Message</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/40">
                @forelse ($donators as $donator)
                <tr class="hover:bg-dark/[0.01] transition-colors group">
                    <td class="px-8 py-6 text-xs font-black text-dark/40">{{ $loop->iteration }}</td>
                    <td class="px-8 py-6">
                        <span class="text-sm font-black text-dark tracking-tight">{{ $donator->donatorName }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-green-500/10 text-green-600 text-[10px] font-black uppercase rounded-lg tracking-widest">
                            ${{ number_format($donator->donationAmount, 2) }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-xs font-bold text-dark/60 italic underline decoration-primary/30 underline-offset-4">{{ $donator->donatorEmail }}</span>
                    </td>
                    <td class="px-8 py-6 text-xs font-bold text-dark/60">{{ $donator->donatorPhone }}</td>
                    <td class="px-8 py-6">
                        <p class="text-[11px] font-medium text-dark/40 leading-relaxed italic max-w-xs truncate group-hover:text-dark/60 transition-colors" title="{{ $donator->description }}">
                            "{{ $donator->description }}"
                        </p>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-12 text-center text-dark/20 uppercase font-black text-sm tracking-widest">No donations found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
