<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Illuminate\Http\Request;

class NotificationController extends ApiController
{
    private $notificationRepo;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        parent::__construct();
        $this->notificationRepo = $notificationRepository;
    }

    public function listNotificationsByUserLogged(Request $request)
    {
        $size = $request->size ? : 5;
        $page = $request->page ? : 1;
        $notifications = $this->notificationRepo->listNotificationByUser(
            $this->user->id,
            $page,
            $size,
            'created_at',
            'desc',
            ['*']
        );
        $readNotificationAt = $this->notificationRepo->readNotificationAtByUser($this->user->id);
        $data['numberCommentUnread'] = $this->notificationRepo->numberCommentUnreadByUser($this->user->id, $readNotificationAt);

        $notifications = $notifications->map(function ($notification) {
            $notification->timeAgo = time_elapsed_string_vi($notification->created_at);
            return $notification;
        });
        $data['notifications'] = $notifications;
        return response($data, 200);
    }

    public function setReadNotification()
    {
        $isCreated = $this->notificationRepo->createReadNotificationAtByUser($this->user->id);
        if ($isCreated) {
            return response(['status' => 'success'], 200);
        }
        abort(500, 'có lỗi đã xảy ra');
    }
}
