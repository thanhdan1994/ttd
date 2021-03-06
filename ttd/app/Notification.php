<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property mixed created_at
 * @property string timeAgo
 * @property int | User creator
 * @property int | User receiver
 * @property MessageType message
 * @property string id
 */
class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'link',
        'model_type',
        'model_id',
        'creator',
        'receiver',
        'message_type_id',
    ];
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver');
    }

    public function message()
    {
        return $this->belongsTo(MessageType::class, 'message_type_id', 'message_type');
    }
}
