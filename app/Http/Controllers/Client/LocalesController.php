<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LocalesController extends Controller
{
    public function switch($locale): RedirectResponse
    {
        if (in_array($locale, config('app.locales'))) {
            session()->put('locale', $locale);
            \Cache::clear();
        }

        return back();
    }
}
