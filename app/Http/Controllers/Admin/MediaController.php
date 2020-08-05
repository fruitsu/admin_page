<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Models\Media;

class MediaController extends Controller
{   

    public function destroy(Request $request, Media $media)
    {
        $media->delete();

        return $request->ajax() ? response(null, 204) : back();
    }
}
