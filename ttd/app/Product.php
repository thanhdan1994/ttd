<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, SearchableTrait;
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
        'lat',
        'long',
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

    /**
     * The services that belong to the product.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class)->orderBy('id', 'desc');
    }

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

    public function thumbnail()
    {
        return $this->hasOne(Media::class, 'id', 'featured_image');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'model')->where('collection_name', 'detail-images');
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

    /**
     * @param $userId
     * @param $productId
     * @return bool
     */
    public function getBookmarkId($userId, $productId)
    {
        $bookmark = Bookmark::where(['user_id' => $userId, 'product_id' => $productId])->first();
        if ($bookmark) {
            return $bookmark->id;
        }
        return false;
    }
}
