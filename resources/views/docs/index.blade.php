<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentation - Merry Meals</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/css/docs.css', 'resources/js/app.js', 'resources/js/docs-animations.js'])
</head>
<body class="bg-background text-foreground font-poppins antialiased transition-colors duration-300">
    
    <x-docs.sidebar :links="$links" />

    <main class="lg:ml-64 min-h-screen">
        
        <x-docs.hero 
            title="Merry Meals Documentation" 
            subtitle="Platform pengiriman makanan berbasis Laravel untuk program Meals on Wheels yang membantu lansia dan penyandang disabilitas."
        />

        <!-- Overview -->
        <x-docs.section id="overview" title="Project Overview">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-docs.card title="Mission Driven" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>'>
                    Membantu lansia dan penyandang disabilitas mendapatkan makanan bergizi melalui jaringan volunteer dan partner restoran.
                </x-docs.card>
                <x-docs.card title="Secure Payments" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>'>
                    Integrasi Stripe yang aman untuk sistem donasi guna mendukung keberlangsungan operasional platform.
                </x-docs.card>
            </div>
        </x-docs.section>

        <!-- Tech Stack -->
        <x-docs.section id="tech-stack" title="Tech Stack">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="doc-card p-4 border border-border rounded-lg text-center bg-card">
                    <span class="block font-bold">Laravel 9.x</span>
                    <span class="text-xs text-muted-foreground">Backend Framework</span>
                </div>
                <div class="doc-card p-4 border border-border rounded-lg text-center bg-card">
                    <span class="block font-bold">PHP 8.0.2+</span>
                    <span class="text-xs text-muted-foreground">Runtime Engine</span>
                </div>
                <div class="doc-card p-4 border border-border rounded-lg text-center bg-card">
                    <span class="block font-bold">GSAP</span>
                    <span class="text-xs text-muted-foreground">Motion Library</span>
                </div>
                <div class="doc-card p-4 border border-border rounded-lg text-center bg-card">
                    <span class="block font-bold">Tailwind CSS</span>
                    <span class="text-xs text-muted-foreground">Design System</span>
                </div>
            </div>
        </x-docs.section>

        <!-- Architecture -->
        <x-docs.section id="architecture" title="System Architecture">
            <div class="space-y-6">
                <p class="text-muted-foreground">Project ini menggunakan <strong>Repository Pattern</strong> untuk pemisahan logika bisnis dan akses data secara bersih.</p>
                <div class="bg-muted p-6 rounded-xl border border-border/50 font-mono text-sm overflow-x-auto">
                    Controller → Service → Repository → Model
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <x-docs.card title="app/Interfaces" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'>
                        Definisi contract repositories. Contoh: <code>UserRepositoryInterface.php</code>
                    </x-docs.card>
                    <x-docs.card title="app/Repositories" icon='<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>'>
                        Implementasi akses data Eloquent. Contoh: <code>UserRepository.php</code>
                    </x-docs.card>
                </div>
            </div>
        </x-docs.section>

        <!-- Colors -->
        <x-docs.section id="colors" title="Color Palette">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-docs.color-swatch name="Primary" color="primary" hex="#FFCE01" />
                <x-docs.color-swatch name="Background" color="background" hex="#FFFCF0" />
                <x-docs.color-swatch name="Accent" color="accent" hex="#A07C00" />
                <x-docs.color-swatch name="Dark" color="dark" hex="#282222" />
                <x-docs.color-swatch name="Border" color="border" hex="#E6E3D8" />
                <x-docs.color-swatch name="Radius" color="radius" hex="0.75rem" />
            </div>
        </x-docs.section>

        <!-- API -->
        <x-docs.section id="api" title="API & Routes">
            <div class="space-y-4">
                <h3 class="text-xl font-bold">Public Routes</h3>
                <x-docs.code-block code="Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/donation', [DonationController::class, 'index'])->name('donation');" />
                
                <h3 class="text-xl font-bold mt-8">Middleware Roles</h3>
                <p class="text-muted-foreground mb-4">Membatasi akses berdasarkan role user (admin, partner, rider, member).</p>
                <x-docs.code-block code="Route::middleware('roles:admin,partner')->group(function () {
    // Protected routes
});" />
            </div>
        </x-docs.section>

        <!-- Installation -->
        <x-docs.section id="installation" title="Installation Guide">
            <div class="space-y-6">
                <p class="text-muted-foreground">Ikuti langkah-langkah berikut untuk menjalankan project di lokal.</p>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-dark font-bold flex-shrink-0">1</div>
                        <div>
                            <p class="font-bold">Clone & Install Dependencies</p>
                            <x-docs.code-block code="git clone https://github.com/yudantaa/merry-meals.git
cd merry-meals
composer install
npm install" language="bash" />
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-dark font-bold flex-shrink-0">2</div>
                        <div>
                            <p class="font-bold">Environment Setup</p>
                            <x-docs.code-block code="cp .env.example .env
php artisan key:generate
# Configure DB_DATABASE, STRIPE_KEY, etc in .env" language="bash" />
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-dark font-bold flex-shrink-0">3</div>
                        <div>
                            <p class="font-bold">Run Database & Server</p>
                            <x-docs.code-block code="php artisan migrate
php artisan db:seed
php artisan serve" language="bash" />
                        </div>
                    </div>
                </div>
            </div>
        </x-docs.section>

        <footer class="py-12 border-t border-border text-center text-muted-foreground text-sm">
            <p>© 2026 Merry Meals Dashboard. Built with Shadcn principles & GSAP.</p>
        </footer>
    </main>

    <!-- Particles Background or Subtle Glow (Optional Shadcn Style) -->
    <div class="fixed top-0 left-0 -z-10 h-full w-full pointer-events-none overflow-hidden">
        <div class="absolute top-[10%] left-[20%] w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[20%] right-[10%] w-[400px] h-[400px] bg-accent/5 rounded-full blur-[100px]"></div>
    </div>
</body>
</html>
