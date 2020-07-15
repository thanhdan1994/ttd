<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    protected $table = 'like';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'user_id',
        'type'
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
