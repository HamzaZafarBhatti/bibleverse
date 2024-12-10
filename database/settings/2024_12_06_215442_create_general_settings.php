<?php

use Filament\Support\Colors\Color;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.app_name', 'Bible Verse');
        $this->migrator->add('general.theme_color', json_encode(Color::Blue));
        $this->migrator->add('general.redirect_url', 'https://votcclothing.com/');
        $this->migrator->add('general.icon', '');
    }
};
