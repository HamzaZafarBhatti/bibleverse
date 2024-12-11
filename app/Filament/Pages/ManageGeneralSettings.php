<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Artisan;

class ManageGeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?int $navigationSort  = 2;

    public function form(Form $form): Form
    {
        $colors = array();
        foreach (Color::all() as $key => $value) {
            $colors[json_encode($value)] = ucfirst($key);
        }
        return $form
            ->schema([
                TextInput::make('app_name')
                    ->label('Site Name')
                    ->required()
                    ->string(),
                Select::make('theme_color')
                    ->options($colors)
                    ->required(),
                TextInput::make('redirect_url')
                    ->required()
                    ->url(),
                FileUpload::make('icon')
                    ->image(),
            ]);
    }

    protected function afterSave(): void
    {
        Artisan::call('config:clear');
        $this->redirect(route('filament.admin.pages.manage-general-settings'));
    }
}
