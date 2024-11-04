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
    public const HOME = '/home';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespaceWeb = 'App\Http\Controllers\Web';
    protected $namespaceApi = 'App\Http\Controllers\API';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->api();
            $this->web();
        });
    }

    /**
     * api routes
     */
    protected function api()
    {
        /**
         * api auth
         */
        Route::group([
            'middleware' => ['auth:api'],
            'prefix' => 'api/auth',
            'namespace' => $this->namespaceApi . '\Auth',
        ], function ($router) {
            require base_path('routes/api/auth/auth.php');
        });

        /**
         * api web
         */
        Route::group([
            'middleware' => ['auth:api', 'resitrict'],
            'prefix' => 'api/web',
            'namespace' => $this->namespaceApi . '\Web',
        ], function ($router) {
            require base_path('routes/api/web/apotek.php');
            require base_path('routes/api/web/bpjs.php');
            require base_path('routes/api/web/dashboard.php');
            require base_path('routes/api/web/farmasi.php');
            require base_path('routes/api/web/helpdesk.php');
            require base_path('routes/api/web/kasir.php');
            require base_path('routes/api/web/laporan.php');
            require base_path('routes/api/web/master-data.php');
            require base_path('routes/api/web/notifikasi.php');
            require base_path('routes/api/web/obat-lock.php');
            require base_path('routes/api/web/pendaftaran.php');
            require base_path('routes/api/web/pengaturan.php');
            require base_path('routes/api/web/poliklinik.php');
            require base_path('routes/api/web/list-pasien.php');
            require base_path('routes/api/web/retail.php');
        });

        /**
         * api mobile
         */
        Route::group([
            'middleware' => ['auth:api', 'resitrict'],
            'prefix' => 'api/mobile',
            'namespace' => $this->namespaceApi . '\Mobile',
        ], function ($router) {
        });

        /**
         * api region
         */
        Route::group([
            'middleware' => ['auth:api'],
            'prefix' => 'api',
            'namespace' => $this->namespaceApi,
        ], function ($router) {
            require base_path('routes/api/region/region.php');
            require base_path('routes/api/web/profil.php');
        });
    }

    /**
     * webroutes
     */
    protected function web()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespaceWeb,
        ], function ($router) {
            require base_path('routes/web.php');
            require base_path('routes/web/apotek.php');
            require base_path('routes/web/bpjs.php');
            require base_path('routes/web/dashboard.php');
            require base_path('routes/web/farmasi.php');
            require base_path('routes/web/helpdesk.php');
            require base_path('routes/web/kasir.php');
            require base_path('routes/web/laporan.php');
            require base_path('routes/web/master-data.php');
            require base_path('routes/web/master-obat.php');
            require base_path('routes/web/notifikasi.php');
            require base_path('routes/web/obat-lock.php');
            require base_path('routes/web/pendaftaran.php');
            require base_path('routes/web/pengaturan.php');
            require base_path('routes/web/poliklinik.php');
            require base_path('routes/web/list-pasien.php');
            require base_path('routes/web/profil.php');
            require base_path('routes/web/retail.php');
            require base_path('routes/web/management-kamar.php');
            require base_path('routes/web/not-found.php');
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
