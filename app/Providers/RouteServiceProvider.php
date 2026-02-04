<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    public const ADMIN_DASHBOARD = 'admin';

    public const MEMBER_DASHBOARD = 'member/menu';

    public const CAREGIVER_DASHBOARD = 'member/menu';

    public const VOLUNTEER_DASHBOARD = 'volunteer';

    public const PARTNER_DASHBOARD = 'partner';

    public const DONOR_DASHBOARD = 'member/menu';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        // Default API rate limiter: 60 requests per minute
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Login rate limiter: 5 attempts per minute (security)
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->input('email').'|'.$request->ip())
                ->response(function () {
                    return redirect()
                        ->back()
                        ->withErrors(['email' => 'Too many login attempts. Please try again in 1 minute.']);
                });
        });

        // Order creation rate limiter: 10 orders per hour
        RateLimiter::for('orders', function (Request $request) {
            return Limit::perHour(10)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function () {
                    return redirect()
                        ->back()
                        ->with('error', 'You have reached the maximum order limit. Please try again later.');
                });
        });

        // Sensitive actions rate limiter: 30 requests per minute
        RateLimiter::for('sensitive', function (Request $request) {
            return Limit::perMinute(30)->by($request->user()?->id ?: $request->ip());
        });

        // Dashboard rate limiter: 120 requests per minute (higher for AJAX)
        RateLimiter::for('dashboard', function (Request $request) {
            return Limit::perMinute(120)->by($request->user()?->id ?: $request->ip());
        });

        // Status update rate limiter: 60 requests per minute
        RateLimiter::for('status-update', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
