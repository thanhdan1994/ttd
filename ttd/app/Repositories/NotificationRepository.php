<?php
namespace App\Repositories;

use App\Notification;
use App\ReadNotificationAt;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    public function __construct(Notification $notification)
    {
        parent::__construct($notification);
        $this->model = $notification;
    }

    /**
     * @param int $userId
     * @param int $page
     * @param int $size
     * @param string $order
     * @param string $sort
     * @param array|string[] $columns
     * @return Collection
     */
    public function listNotificationByUser(int $userId, int $page = 1, int $size = 10, string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        $skip = $page * $size - $size;
        return $this->model->where(['receiver' => $userId])->select($columns)->with(['creator', 'receiver', 'message'])->orderBy($order, $sort)->skip($skip)->take($size)->get();
    }

    /**
     * @param int $userId
     * @param ReadNotificationAt|null $readNotificationAt
     * @return int
     */
    public function numberCommentUnreadByUser(int $userId, ReadNotificationAt $readNotificationAt = null): int
    {
        if ($readNotificationAt) {
            return $this->model->where('receiver' , $userId)
                ->whereRaw('created_at >= ?', Carbon::parse($readNotificationAt->read_at)->format('Y-m-d H:i:s'))
                ->count();
        }
        return $this->model->where('receiver' , $userId)->count();
    }

    /**
     * @param int $userId
     * @return ReadNotificationAt
     */
    public function readNotificationAtByUser(int $userId): ReadNotificationAt
    {
        return ReadNotificationAt::where('reader', $userId)
            ->orderBy('read_at', 'desc')->first();
    }

    /**
     * @param int $userId
     * @return ReadNotificationAt
     */
    public function createReadNotificationAtByUser(int $userId): ReadNotificationAt
    {
        $readAt = ReadNotificationAt::firstOrCreate([
            'reader' => $userId
        ]);
        $readAt->read_at = now();
        return $readAt->save();
    }
}
