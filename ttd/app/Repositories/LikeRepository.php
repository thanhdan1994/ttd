<?php
namespace App\Repositories;

use App\Comment;
use App\Like;
use App\Product;
use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    /**
     * ProductRepository constructor.
     * @param Like $like
     */
    public function __construct(Like $like)
    {
        parent::__construct($like);
        $this->model = $like;
    }


    public function isProductLikedByUser(int $userId, int $productId): bool
    {
        return $this->model->where([
            'user_id' => $userId,
            'type' => Like::TYPE_LIKE,
            'model_type' => Product::class,
            'model_id' => $productId
        ])->first() ? true : false;
    }

    public function isProductUnlikedByUser(int $userId, int $productId): bool
    {
        return $this->model->where([
            'user_id' => $userId,
            'type' => Like::TYPE_DISLIKE,
            'model_type' => Product::class,
            'model_id' => $productId
        ])->first() ? true : false;
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return mixed
     */
    public function clearLikeOrUnlikeProductByUser(int $userId, int $productId)
    {
        return $this->model->where([
            'model_type' => Product::class,
            'model_id' => $productId,
            'user_id' => $userId
        ])->delete();
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return mixed
     */
    public function likeProductByUser(int $userId, int $productId) : Like
    {
        return $this->create([
            'model_type' => Product::class,
            'model_id' => $productId,
            'user_id' => $userId,
            'type' => Like::TYPE_LIKE
        ]);
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return mixed
     */
    public function dislikeProductByUser(int $userId, int $productId) : Like
    {
        return $this->create([
            'model_type' => Product::class,
            'model_id' => $productId,
            'user_id' => $userId,
            'type' => Like::TYPE_DISLIKE
        ]);
    }

    /**
     * @param int $userId
     * @param int $commentId
     * @return mixed
     */
    public function clearLikeOrUnlikeCommentByUser(int $userId, int $commentId)
    {
        return $this->model->where([
            'model_type' => Comment::class,
            'model_id' => $commentId,
            'user_id' => $userId
        ])->delete();
    }

    /**
     * @param int $userId
     * @param int $commentId
     * @return mixed
     */
    public function likeCommentByUser(int $userId, int $commentId) : Like
    {
        return $this->create([
            'model_type' => Comment::class,
            'model_id' => $commentId,
            'user_id' => $userId,
            'type' => Like::TYPE_LIKE
        ]);
    }

    /**
     * @param int $userId
     * @param int $commentId
     * @return mixed
     */
    public function unlikeCommentByUser(int $userId, int $commentId) : Like
    {
        return $this->create([
            'model_type' => Comment::class,
            'model_id' => $commentId,
            'user_id' => $userId,
            'type' => Like::TYPE_DISLIKE
        ]);
    }

    /**
     * @param int $commentId
     * @return int
     */
    public function numberCommentLiked(int $commentId): int
    {
        return $this->countBy([
            'type' => Like::TYPE_LIKE,
            'model_type' => Comment::class,
            'model_id' => $commentId
        ]);
    }

    /**
     * @param int $userId
     * @param int $commentId
     * @return bool
     */
    public function isCommentLikedByUser(int $userId, int $commentId): bool
    {
        return $this->model->where([
            'user_id' => $userId,
            'type' => Like::TYPE_LIKE,
            'model_type' => Comment::class,
            'model_id' => $commentId
        ])->first() ? true : false;
    }
}
