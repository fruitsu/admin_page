<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Career extends Model
{
    use HasTranslations;

    protected $translatable = [
        'title',
        'description'
    ];

    protected $fillable = [
        'title',
        'description'
    ];

    protected $with = [
        'metas'
    ];

    public function metas(): MorphOne
    {
        return $this->morphOne(Meta::class, 'metable');
    }
}
