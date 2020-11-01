<?php
namespace App\Repositories\Interfaces;

use App\ReadNotificationAt;
use Illuminate\Support\Collection;

interface NotificationRepositoryInterface extends BaseRepositoryInterface
{
    public function listNotificationByUser(
        int $userId,
        int $page = 1,
        int $size = 10,
        string $order = 'id',
        string $sort = 'desc',
        array $columns = ['*']
    ) : Collection;

    public function numberCommentUnreadByUser(int $userId, ReadNotificationAt $readNotificationAt = null) : int;

    public function readNotificationAtByUser(int $userId);

    public function createReadNotificationAtByUser(int $userId) : bool;
}
