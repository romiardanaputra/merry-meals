<div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/50 overflow-hidden animate-on-scroll">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-dark/5 border-b border-border/50">
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">No</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Donator Name</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Amount</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">E-mail</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Contact</th>
                    <th class="px-8 py-6 text-h6 text-dark tracking-tight">Message</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/30">
                @foreach ($donators as $donator)
                <tr class="hover:bg-primary/5 transition-colors duration-300">
                    <td class="px-8 py-6 text-p font-bold text-dark/40">{{ $loop->iteration }}</td>
                    <td class="px-8 py-6">
                        <span class="text-p font-bold text-dark tracking-tight">{{ $donator->donatorName }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-4 py-2 bg-green-500/10 text-green-600 text-sm font-black rounded-xl border border-green-500/20">
                            ${{ number_format($donator->donationAmount, 2) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-p font-medium text-dark/60 italic underline decoration-primary/30">{{ $donator->donatorEmail }}</td>
                    <td class="px-8 py-6 text-p font-medium text-dark/60">{{ $donator->donatorPhone }}</td>
                    <td class="px-8 py-6">
                        <p class="text-p text-dark/40 leading-relaxed italic max-w-xs truncate" title="{{ $donator->description }}">
                            "{{ $donator->description }}"
                        </p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
