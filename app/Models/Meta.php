<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;
class Meta extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'metable_type', 
        'metable_id'
    ];

    protected $translatable = [
        'title', 'description'
    ];

    /**
     * @return MorphTo
     */
    public function metable(): MorphTo
    {
        return $this->morphTo();
    }
}
