<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'parent',
        'featured_image',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection(env('COLLECTION_NAME_THUMBNAIL'))
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(250)
                    ->height(200);
                $this->addMediaConversion('thumb-350')
                    ->width(350)
                    ->height(240);
            });
        $this->addMediaCollection(env('COLLECTION_NAME_DETAIL_IMAGES'))
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(250)
                    ->height(200);
                $this->addMediaConversion('thumb-350')
                    ->width(350)
                    ->height(240);
            });
    }

    public function products()
    {
        return $this->hasMany(Product::class)
            ->where(['status' => 1])
            ->orderBy('id', 'desc');
    }

    public function thumbnail()
    {
        return $this->hasOne(Media::class, 'id', 'featured_image');
    }

    public function getThumbnailUrlAttribute()
    {
        $thumbnail = 'https://cuoifly.tuoitre.vn/155/0/ttc/r/2020/02/03/logo-ttc-1580721954.png';
        if ($this->thumbnail !== null) :
            $thumbnail = $this->thumbnail->getUrl('thumb-350');
        endif;
        return $thumbnail;
    }
}
