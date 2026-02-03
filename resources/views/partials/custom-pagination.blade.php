@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
        {{-- Progress Info --}}
        <div class="text-center md:text-left">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-dark/20">
                Displaying 
                <span class="text-dark/60">{{ $paginator->firstItem() }}</span>
                to 
                <span class="text-dark/60">{{ $paginator->lastItem() }}</span>
                of 
                <span class="text-dark/60">{{ $paginator->total() }}</span>
                Records
            </p>
        </div>

        {{-- Desktop Navigation (Hidden on Mobile) --}}
        <div class="hidden md:flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 rounded-xl bg-dark/5 text-dark/10 flex items-center justify-center cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 rounded-xl bg-white border border-black/5 text-dark/40 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm shadow-dark/5 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 text-dark/20 font-black tracking-widest">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center text-[10px] font-black shadow-lg shadow-primary/20 ring-4 ring-primary/10">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 rounded-xl bg-white border border-black/5 text-dark/40 flex items-center justify-center text-[10px] font-black hover:bg-dark hover:text-white hover:border-dark transition-all duration-300 shadow-sm shadow-dark/5 active:scale-95">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 rounded-xl bg-white border border-black/5 text-dark/40 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm shadow-dark/5 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span class="w-10 h-10 rounded-xl bg-dark/5 text-dark/10 flex items-center justify-center cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>

        {{-- Mobile Navigation (Simplified) --}}
        <div class="flex md:hidden items-center justify-between w-full sm:w-auto sm:justify-center sm:space-x-4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-6 py-3 rounded-xl bg-dark/5 text-dark/10 text-[10px] font-black uppercase tracking-widest cursor-not-allowed">
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-6 py-3 rounded-xl bg-white border border-black/5 text-dark/40 text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm active:scale-95">
                    Prev
                </a>
            @endif

            {{-- Page Info --}}
            <div class="flex flex-col items-center">
                <span class="text-[10px] font-black text-dark tracking-tighter">
                   {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                </span>
                <span class="text-[8px] font-black text-dark/20 uppercase tracking-widest">Page</span>
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-6 py-3 rounded-xl bg-white border border-black/5 text-dark/40 text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm active:scale-95">
                    Next
                </a>
            @else
                <span class="px-6 py-3 rounded-xl bg-dark/5 text-dark/10 text-[10px] font-black uppercase tracking-widest cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </div>
@endif
