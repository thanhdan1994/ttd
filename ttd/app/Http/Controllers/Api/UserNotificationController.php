<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notification;
use App\ReadNotificationAt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            ->orderBy('created_at', 'desc')
            ->paginate($size);
        $readAt = ReadNotificationAt::where('reader', $request->user()->id)
                    ->orderBy('read_at', 'desc')->first();
        if ($readAt) {
            $data['numberNotSeen'] = Notification::where('receiver', $request->user()->id)
                ->whereRaw('created_at >= ?', Carbon::parse($readAt->read_at)->format('Y-m-d H:i:s'))
                ->count();
        } else {
            $data['numberNotSeen'] = Notification::where('receiver', $request->user()->id)
                ->count();
        }
        $notifications = $notifications->map(function (Notification $notification) {
            $notification->timeAgo = time_elapsed_string_vi($notification->created_at);
            return $notification;
        });
        $data['notifications'] = $notifications;
        return response($data, 200);
    }

    public function setReadNotification(Request $request)
    {
        $reader = $request->user()->id;
        $readAt = ReadNotificationAt::firstOrCreate([
            'reader' => $reader
        ]);
        $readAt->read_at = now();
        $readAt->save();
    }
}
