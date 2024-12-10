<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $app_name;
    public string $theme_color;
    public string $redirect_url;
    public string $icon;

    public static function group(): string
    {
        return 'general';
    }
}