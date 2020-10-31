<?php
namespace App\Repositories\Interfaces;

use App\Bookmark;
use Illuminate\Support\Collection;

interface BookmarkRepositoryInterface extends BaseRepositoryInterface
{
    public function bookmarkProductByUser(int $userId, int $productId): Bookmark;

    public function unbookmarkProductByUser(int $userId, int $productId) : bool;

    public function listBookmarkByUserId(
        int $id,
        int $page = 1,
        int $size = 10,
        string $order = 'id',
        string $sort = 'desc',
        array $columns = ['*']
    ) : Collection;

    public function isProductBookmarkedByUser(int $userId, int $productId) : bool;
}
