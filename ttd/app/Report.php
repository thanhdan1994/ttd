<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Report extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'product_id',
        'excerpt',
        'user_id',
        'properties',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection(env('COLLECTION_NAME_THUMBNAIL'))
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(150);
                $this->addMediaConversion('thumb-350')
                    ->width(350)
                    ->height(240);
            });
        $this->addMediaCollection(env('COLLECTION_NAME_DETAIL_IMAGES'))
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(150);
                $this->addMediaConversion('thumb-350')
                    ->width(350)
                    ->height(240);
            });
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function setPropertiesAttribute($value)
    {
        $properties = [];
        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $properties[] = $array_item;
            }
        }
        $this->attributes['properties'] = json_encode($properties);
    }
}
