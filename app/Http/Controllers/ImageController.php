<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Settings\GeneralSettings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class ImageController extends Controller
{
    public function show(Request $request, GeneralSettings $settings)
    {
        $today = now()->toDateString();
        $userIdentifier = $request->session()->getId();

        $cacheEnglishKey = 'english_image_for_the_day_' . $today . '_' . $userIdentifier;
        $cacheSpanishKey = 'spanish_image_for_the_day_' . $today . '_' . $userIdentifier;

        $cachedEnglishImage = Cache::get($cacheEnglishKey);
        $cachedSpanishImage = Cache::get($cacheSpanishKey);

        if (!$cachedEnglishImage) {
            $cachedEnglishImage = Image::select('image')->language('english')->inRandomOrder()->first();
            Cache::put($cacheEnglishKey, $cachedEnglishImage, now()->endOfDay());
        }
        if (!$cachedSpanishImage) {
            $cachedSpanishImage = Image::select('image')->language('spanish')->inRandomOrder()->first();
            Cache::put($cacheSpanishKey, $cachedSpanishImage, now()->endOfDay());
        }

        $redirectUrl = $settings->redirect_url;
        $icon = $settings->icon;

        return view('image.show', compact('cachedEnglishImage', 'cachedSpanishImage', 'redirectUrl', 'icon'));
    }
}
