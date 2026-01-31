<div x-data="donationTiers()" class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl shadow-primary/5 border border-border/50 animate-on-scroll">
    <div class="space-y-10">
        <!-- Section Header -->
        <div class="space-y-3">
            <h4 class="text-h4 text-dark tracking-tight">Support Our Mission</h4>
            <p class="text-foreground/60 font-medium">Choose an amount to help end senior hunger today.</p>
        </div>

        <!-- Tiers Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <template x-for="tier in tiers" :key="tier.amount">
                <button 
                    @click="setAmount(tier.amount)"
                    :class="selectedAmount == tier.amount ? 'bg-primary border-primary text-dark shadow-xl shadow-primary/20 scale-105' : 'bg-background-soft border-border/40 text-foreground/70 hover:border-primary/50'"
                    class="relative flex flex-col items-center justify-center p-6 rounded-3xl border-2 transition-all duration-300 group">
                    <span class="text-xs font-black uppercase tracking-widest opacity-40 group-hover:opacity-100 transition-opacity" x-text="'$' + tier.amount"></span>
                    <h5 class="text-h5 font-black mt-1" x-text="'$' + tier.amount"></h5>
                </button>
            </template>
        </div>

        <!-- Custom Input -->
        <div class="relative">
            <label class="block text-sm font-semibold text-dark mb-3">Or enter a custom amount</label>
            <div class="relative">
                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-h5 font-black text-foreground/30">$</span>
                <input type="number" x-model="selectedAmount" @input="isCustom = true"
                    class="w-full pl-12 pr-6 py-5 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-h5 font-black text-dark placeholder:text-foreground/20"
                    placeholder="Enter amount">
            </div>
        </div>

        <!-- Impact Preview -->
        <div class="p-6 bg-primary/5 rounded-2xl border border-primary/10 flex items-center gap-5 transition-all" x-show="selectedAmount > 0" x-transition.fade>
            <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.703 2.703 0 01-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 01-1.5-.454M9 16v2m3-6v6m3-3v3M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-sm font-bold text-dark italic leading-snug">
                Your <span class="text-primary" x-text="'$' + selectedAmount"></span> donation will provide approximately <span class="text-primary" x-text="Math.floor(selectedAmount / 10)"></span> nutritious meal packages.
            </p>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button class="w-full py-6 bg-dark text-white text-h6 font-black rounded-2xl shadow-2xl hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                Donate Now
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function donationTiers() {
        return {
            selectedAmount: 20,
            isCustom: false,
            tiers: [
                { amount: 5 },
                { amount: 10 },
                { amount: 20 },
                { amount: 50 }
            ],
            setAmount(amt) {
                this.selectedAmount = amt;
                this.isCustom = false;
            }
        }
    }
</script>
