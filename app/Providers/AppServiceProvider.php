<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $generalSettings = app(GeneralSettings::class);
        if ($generalSettings->app_name !== config('app.name')) {
            setEnvValue('APP_NAME', '"' . $generalSettings->app_name . '"');
        }
        if ($generalSettings->theme_color !== json_encode(cache('app_theme_color'))) {
            Cache::forever('app_theme_color', json_decode($generalSettings->theme_color, true));
        }
    }
}
