<div class="space-y-4 animate-on-scroll">
    {{-- Header Row (Desktop) --}}
    <div class="hidden lg:grid grid-cols-12 px-8 py-3 bg-gray-50/50 rounded-xl mb-4">
        <div class="col-span-1 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">#</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Donator Identity</div>
        <div class="col-span-2 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Contribution</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Contact Information</div>
        <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Message/Note</div>
    </div>

    <div class="space-y-4">
        @forelse ($donators as $donator)
        <div class="bg-white rounded-2xl p-6 lg:p-0 lg:px-8 lg:py-6 flex flex-col lg:grid lg:grid-cols-12 items-center gap-4 lg:gap-0 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 group border border-transparent hover:border-primary/10">
            {{-- No --}}
            <div class="lg:col-span-1 hidden lg:block">
                <span class="text-xs font-black text-dark/20">{{ $loop->iteration }}</span>
            </div>

            {{-- Donator Identity --}}
            <div class="lg:col-span-3 w-full">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                        <span class="text-primary font-black text-lg uppercase">{{ substr($donator->donatorName, 0, 1) }}</span>
                    </div>
                    <span class="text-sm font-black text-dark tracking-tight truncate">{{ $donator->donatorName }}</span>
                </div>
            </div>

            {{-- Amount --}}
            <div class="lg:col-span-2 w-full">
                <div class="flex flex-col">
                    <span class="text-[8px] font-black text-dark/20 uppercase tracking-widest mb-1">Amount</span>
                    <span class="px-4 py-2 bg-green-100 text-green-700 text-[11px] font-black rounded-xl border border-green-200 inline-block w-fit shadow-sm">
                        ${{ number_format($donator->donationAmount, 2) }}
                    </span>
                </div>
            </div>

            {{-- Contact --}}
            <div class="lg:col-span-3 w-full">
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-dark/60 tracking-tight truncate">{{ $donator->donatorEmail }}</span>
                    <span class="text-[10px] font-bold text-dark/30 tracking-widest">{{ $donator->donatorPhone }}</span>
                </div>
            </div>

            {{-- Message --}}
            <div class="lg:col-span-3 w-full">
                <div class="bg-gray-50/50 p-4 rounded-xl border border-black/5 group-hover:bg-white group-hover:border-primary/10 transition-all duration-500">
                    <p class="text-[11px] font-medium text-dark/50 leading-relaxed italic line-clamp-2 group-hover:text-dark/80 transition-colors">
                        "{{ $donator->description ?: 'No message provided' }}"
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl p-16 text-center shadow-sm border border-black/5">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <p class="text-sm font-black text-dark/20 uppercase tracking-[0.3em]">No donation records found</p>
        </div>
        @endforelse
    </div>
</div>

