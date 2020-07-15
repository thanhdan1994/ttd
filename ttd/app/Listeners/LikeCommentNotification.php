<?php
namespace App\Listeners;

use App\Events\LikeComment;

class LikeCommentNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LikeComment $event
     * @return void
     */
    public function handle(LikeComment $event)
    {
        // Access the message using $event->message...
        $event->message;
        $event->author_id;
    }
}
