<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */

 //  خاص ب  المستخدم تبع الموقع login
    public const HOME = '/';
 // خاص ب الادمن تبع  لوحه التحكم login
    public const ADMIN = '/admin';
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();// Api الخاص ب route نعرف

        $this->mapWebRoutes();//   (الموقع) web الخاص ب route نعرف

        $this->mapAdminRoutes();// admin   الخاص بroute نعرف



        //
    }
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */





     // web تبع  route  الموقع) ربط) web  داله خاصه ب
     protected function mapWebRoutes()
     {
         Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
     }

    // admin تبع  route  ربط admin  داله خاصه ب

    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }








    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
