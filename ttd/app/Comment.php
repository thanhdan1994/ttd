<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'product_id',
        'content',
        'user_id',
        'parent'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
        'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent', 'id')->orderBy('created_at', 'asc');
    }

    public function like()
    {
        return $this->morphMany(Like::class, 'model')->where('type', 1);
    }

    public function unlike()
    {
        return $this->morphMany(Like::class, 'model')->where('type', 2);
    }
}
