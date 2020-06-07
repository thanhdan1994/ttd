<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getThumbnailUrlAttribute()
    {
        return 'https://kuruma-tabinavi.com/wp-content/themes/campingcardesktop/shared/img/default-camping-car.jpg';
    }
}
