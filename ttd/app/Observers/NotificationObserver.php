<?php
namespace App\Observers;

use App\Events\UserEvent;
use App\Notification;

class NotificationObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Notification $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        $newNotification = $notification->with(['creator', 'receiver', 'message'])->find($notification->id);
        // execute event send notification to user
        event(new UserEvent($newNotification, $notification->receiver));
    }
}
