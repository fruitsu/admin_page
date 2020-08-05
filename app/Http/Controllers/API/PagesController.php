<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

class PagesController extends Controller
{
    public function index(): JsonResource
    {
        return JsonResource::collection(Page::all());
    }

    public function show(Page $page): JsonResource
    {
        return new JsonResource($page);
    }
}
