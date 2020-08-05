<?php

namespace App\Http\Controllers\Api;

use App\Models\Career;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class CareersController extends Controller
{
    public function index(): JsonResource
    {
        return JsonResource::collection(Career::all());
    }

    public function show(Career $career): JsonResource
    {
        return new JsonResource($career);
    }
}
