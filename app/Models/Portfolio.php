<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\Image\Exceptions\InvalidManipulation;
use Illuminate\Database\Eloquent\Relations\MorphOne;


class Portfolio extends Model implements HasMedia
{
    use HasTranslations, HasMediaTrait;

    protected $translatable = [
        'title',
        'body'
    ];

    protected $fillable = [
        'title',
        'body',
        'slug'
    ];

    protected $with = [
        'metas',
        'media'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function metas(): MorphOne
    {
        return $this->morphOne(Meta::class, 'metable');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->sharpen(10)
            ->keepOriginalImageFormat();
    }
}
