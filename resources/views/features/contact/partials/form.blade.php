<div x-data="contactForm()" class="bg-white p-8 md:p-12 rounded-[2rem] shadow-2xl shadow-primary/5 border border-border/50 animate-on-scroll">
    <form @submit.prevent="submitForm">
        @csrf
        <!-- Honeypot Field -->
        <div class="hidden">
            <input type="text" name="b_name" x-model="formData.b_name">
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="relative">
                    <label class="block text-sm font-bold text-dark mb-2">Full Name</label>
                    <input type="text" name="name" x-model="formData.name" required
                        class="w-full px-5 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/30"
                        placeholder="John Doe">
                </div>
                <!-- Email -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-dark mb-2">Email Address</label>
                    <input type="email" name="email" x-model="formData.email" required
                        class="w-full px-5 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/30"
                        placeholder="john@example.com">
                </div>
            </div>

            <!-- Category -->
            <div class="relative">
                <label class="block text-sm font-semibold text-dark mb-2">Inquiry Category</label>
                <select name="category" x-model="formData.category" required
                    class="w-full px-5 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium appearance-none">
                    <option value="" disabled selected>Select a category</option>
                    <option value="support">General Support</option>
                    <option value="partnership">Partnership Opportunity</option>
                    <option value="donation">Donation Inquiry</option>
                    <option value="volunteer">Volunteer Program</option>
                </select>
                <div class="absolute right-5 bottom-4 pointer-events-none text-foreground/50">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Message -->
            <div class="relative">
                <label class="block text-sm font-semibold text-dark mb-2">Your Message</label>
                <textarea name="message" x-model="formData.message" rows="5" required
                    class="w-full px-5 py-4 bg-background-soft border border-border/40 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-dark font-medium placeholder:text-foreground/30 resize-none"
                    placeholder="How can we help you?"></textarea>
            </div>

            <!-- Action -->
            <div class="pt-4">
                <button type="submit" :disabled="loading"
                    class="w-full py-5 bg-dark text-white font-black rounded-2xl shadow-xl hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3 disabled:opacity-70">
                    <template x-if="!loading">
                        <span class="flex items-center gap-3">
                            Send Message
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </template>
                    <template x-if="loading">
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </template>
                </button>
            </div>
        </div>
    </form>

    <!-- Success Message Overlay -->
    <div x-show="success" x-transition.opacity
        class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center rounded-[2rem] z-20">
        <div class="text-center space-y-4 p-8">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-dark tracking-tight">Message Sent Successfully!</h3>
            <p class="text-foreground/70 font-medium">Thank you for reaching out. Our team will get back to you shortly.</p>
            <button @click="success = false; resetForm()" class="mt-8 px-8 py-3 bg-dark text-white font-bold rounded-xl hover:scale-105 transition-all">Send Another</button>
        </div>
    </div>
</div>

<script>
    function contactForm() {
        return {
            loading: false,
            success: false,
            formData: {
                name: '',
                email: '',
                category: '',
                message: '',
                b_name: '' // Honeypot
            },
            resetForm() {
                this.formData = { name: '', email: '', category: '', message: '', b_name: '' };
            },
            async submitForm() {
                if (this.formData.b_name) return; // Silent fail for bots

                this.loading = true;
                try {
                    const response = await fetch("{{ route('contact.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.formData)
                    });

                    if (response.ok) {
                        this.success = true;
                        this.resetForm();
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please check your connection.');
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
