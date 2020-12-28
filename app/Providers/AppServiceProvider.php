<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\CustomBladeDirectives;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Locale (Por ahora se usa \App\Helpers\Today::now() debido a la hora del server)
        // \Carbon\Carbon::setLocale(LC_TIME, $this->app->getLocale());
        // setlocale(LC_TIME, $this->app->getLocale());
        // Custom Blade Directives
        CustomBladeDirectives::boot();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('es_ES');
        });
    }
}
