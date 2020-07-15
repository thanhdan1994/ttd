<?php
namespace App\Events;

use App\Comment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LikeComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $author_id;

    public function __construct(string $message, int $author_id)
    {
        $this->message = $message;
        $this->author_id = $author_id;
    }

    public function broadcastOn()
    {
        return ['likeComment-channel.'.$this->author_id];
    }

    public function broadcastAs()
    {
        return 'likeComment-event';
    }
}
