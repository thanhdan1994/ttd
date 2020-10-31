<?php
namespace App\Repositories;

use App\Bookmark;
use App\Repositories\Interfaces\BookmarkRepositoryInterface;
use Illuminate\Support\Collection;

class BookmarkRepository extends BaseRepository implements BookmarkRepositoryInterface
{
    /**
     * ProductRepository constructor.
     * @param Bookmark $bookmark
     */
    public function __construct(Bookmark $bookmark)
    {
        parent::__construct($bookmark);
        $this->model = $bookmark;
    }


    /**
     * @param int $userId
     * @param int $productId
     * @return bool
     */
    public function isProductBookmarkedByUser(int $userId, int $productId): bool
    {
        return $this->model->where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->first() ? true : false;
    }

    /**
     * @param int $id
     * @param int $page
     * @param int $size
     * @param string $order
     * @param string $sort
     * @param array|string[] $columns
     * @return Collection
     */
    public function listBookmarkByUserId(int $id, int $page = 1, int $size = 10, string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        $skip = $page * $size - $size;
        return $this->model->where(['user_id' => $id])->select($columns)->orderBy($order, $sort)->skip($skip)->take($size)->get();
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return Bookmark
     */
    public function bookmarkProductByUser(int $userId, int $productId): Bookmark
    {
        return $this->create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return bool
     */
    public function unbookmarkProductByUser(int $userId, int $productId): bool
    {
        return $this->deleteBy([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
    }
}
