<?php

use Illuminate\Support\Facades\File;

if (!function_exists('setEnvValue')) {
    function setEnvValue(string $key, string $value): void
    {
        $path = base_path('.env');
        if (File::exists($path)) {
            File::put($path, preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$value}",
                File::get($path)
            ));
        }
    }
}
