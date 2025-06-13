<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit; // Tambahkan ini
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request; // Tambahkan ini
use Illuminate\Support\Facades\RateLimiter; // Tambahkan ini
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    // Diubah agar HOME mengarah ke dashboard admin secara default
    public const HOME = '/admin/dashboard';

    // Konstan baru untuk dashboard admin (sudah ada sebelumnya)
    public const ADMIN_DASHBOARD = '/admin/dashboard';

    // Konstan baru untuk dashboard user biasa (sudah ada sebelumnya)
    public const USER_DASHBOARD = '/user/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
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
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
