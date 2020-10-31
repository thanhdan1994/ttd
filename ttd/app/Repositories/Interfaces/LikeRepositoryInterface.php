<?php
namespace App\Repositories\Interfaces;

use App\Like;

interface LikeRepositoryInterface
{
    // like model product
    public function isProductLikedByUser(int $userId, int $productId) : bool;

    public function isProductUnlikedByUser(int $userId, int $productId) : bool;

    public function clearLikeOrUnlikeProductByUser(int $userId, int $productId);

    public function likeProductByUser(int $userId, int $productId) : Like;

    public function dislikeProductByUser(int $userId, int $productId) : Like;

    // like model comment
    public function clearLikeOrUnlikeCommentByUser(int $userId, int $commentId);

    public function likeCommentByUser(int $userId, int $commentId) : Like;

    public function unlikeCommentByUser(int $userId, int $commentId) : Like;

    public function numberCommentLiked(int $commentId) : int;

    public function isCommentLikedByUser(int $userId, int $commentId) : bool;
}
