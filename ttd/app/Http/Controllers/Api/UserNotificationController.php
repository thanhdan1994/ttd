<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notification;
use App\User;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function index(User $user, Request $request)
    {
        $size = 10;
        if ($request->size) {
            $size = $request->size;
        }
        $notifications = Notification::with(['creator', 'receiver', 'message'])
            ->where('receiver', $request->user()->id)
            ->paginate($size);
        $notifications = $notifications->map(function (Notification $notification) {
            $notification->timeAgo = time_elapsed_string_vi($notification->created_at);
            return $notification;
        });
        return response($notifications, 200);
    }
}
