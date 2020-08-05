<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfoliosController extends Controller
{
    public function index(): JsonResource
    {
        return JsonResource::collection(Portfolio::all());
    }

    public function show(Portfolio $portfolio): JsonResource
    {
        return new JsonResource($portfolio);
    }
}
