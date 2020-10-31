<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string model_type
 * @property int model_id
 * @property User user_id
 * @property User | Product model
 * @property int type
 */
class Like extends Model
{
    protected $table = 'like';

    const TYPE_LIKE = 1;
    const TYPE_DISLIKE = 2;

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
