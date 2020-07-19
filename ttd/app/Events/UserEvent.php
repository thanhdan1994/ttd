<?php
namespace App\Events;

use App\Notification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;
    public $author_id;

    public function __construct($notification, int $author_id)
    {
        $this->notification = $notification;
        $this->author_id = $author_id;
    }

    public function broadcastOn()
    {
        return ['user-channel.'.$this->author_id];
    }

    public function broadcastAs()
    {
        return 'user-event';
    }
}
