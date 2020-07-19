<?php
namespace App\Listeners;

use App\Events\UserEvent;

class UserNotification
{
    /**
     * Handle the event.
     *
     * @param UserEvent $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        $event->notification;
    }
}
