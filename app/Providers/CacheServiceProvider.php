<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Cache::rememberForever('settings', function() {
            return Setting::all()->groupBy('type');
        });

        \Cache::rememberForever('about', function() {
            return Page::whereSlug('about')->first();
        });
    }
}
