<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadNotificationAt extends Model
{
    protected $table = 'read_notification_at';

    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'reader',
    ];
}
