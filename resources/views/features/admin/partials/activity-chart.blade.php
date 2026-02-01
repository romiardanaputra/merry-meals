<div class="bg-white rounded-xl p-12 shadow-sm border border-black/5 animate-on-scroll">
    <div class="flex justify-between items-center mb-12">
        <div>
            <h6 class="text-h6 text-dark tracking-tight">Active Analytics</h6>
            <p class="text-[12px] font-bold text-dark/30 italic">Real-time donation flow</p>
        </div>
        <select class="px-4 py-2 bg-dark/5 border-none rounded-xl text-xs font-black uppercase tracking-widest text-dark focus:ring-primary">
            <option>Monthly</option>
            <option>Weekly</option>
        </select>
    </div>

    <!-- Mock Bar Chart -->
    <div class="flex items-end justify-between h-48 gap-4 px-2">
        @foreach([20, 35, 25, 60, 45, 30, 40] as $height)
            <div class="flex-1 group relative">
                <div class="bg-dark/5 rounded-t-2xl w-full h-48 absolute bottom-0"></div>
                <div class="bg-primary hover:bg-dark transition-all duration-500 rounded-t-2xl w-full absolute bottom-0 shadow-lg shadow-primary/20" 
                     style="height: {{ $height }}%">
                    <div class="opacity-0 group-hover:opacity-100 absolute -top-10 left-1/2 -translate-x-1/2 bg-dark text-white text-[10px] font-black px-3 py-1.5 rounded-lg transition-opacity">
                        {{ $height }}k
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="flex justify-between mt-6 px-2">
        @foreach(['1 Sep', '2 Sep', '3 Sep', '4 Sep', '5 Sep', '6 Sep', '7 Sep'] as $label)
            <span class="text-[10px] font-black uppercase tracking-widest text-dark/20">{{ $label }}</span>
        @endforeach
    </div>
</div>
