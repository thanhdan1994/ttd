<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasMediaTrait, SearchableTrait;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'amount',
        'phone',
        'address',
        'location',
        'user_id',
        'status',
        'properties',
    ];
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'products.name' => 5,
            'categories.name' => 10
        ],
        'joins' => [
            'categories' => ['products.category_id', 'categories.id'],
        ],
    ];

    /**
     * Scope a query to only include Auth users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoggedUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->where('parent', 0)
            ->orderBy('id', 'desc');
    }

    public function reports()
    {
        return $this->hasMany(Report::class)->orderBy('id', 'desc');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('images')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(150);
                $this->addMediaConversion('thumb-350')
                    ->width(350)
                    ->height(240);
            });
        $this->addMediaCollection('detail-images')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(150);
                $this->addMediaConversion('thumb-350')
                    ->width(350)
                    ->height(240);
            });
    }

    public function thumbnail()
    {
        return $this->hasOne(Media::class, 'id', 'featured_image');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'model');
    }


    public function getThumbnailUrlAttribute()
    {
        $thumbnail = 'https://cuoifly.tuoitre.vn/155/0/ttc/r/2020/02/03/logo-ttc-1580721954.png';
        if ($this->thumbnail !== null) :
            $thumbnail = $this->thumbnail->getUrl('thumb-350');
        endif;
        return $thumbnail;
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
