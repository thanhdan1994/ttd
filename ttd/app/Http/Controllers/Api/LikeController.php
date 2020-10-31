<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\LikeRepositoryInterface;

class LikeController extends ApiController
{
    private $likeRepo;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        parent::__construct();
        $this->likeRepo = $likeRepository;
    }

    public function likeProduct($productId)
    {
        // delete like/dislike
        $this->likeRepo->clearLikeOrUnlikeProductByUser($this->user->id, $productId);
        $like = $this->likeRepo->likeProductByUser($this->user->id, $productId);
        return response(['data' => $like, 'status' => 200], 200);
    }

    public function dislikeProduct($productId)
    {

        // delete like/dislike
        $this->likeRepo->clearLikeOrUnlikeProductByUser($this->user->id, $productId);
        $unlike = $this->likeRepo->dislikeProductByUser($this->user->id, $productId);
        return response(['data' => $unlike, 'status' => 200], 200);
    }

    public function likeComment($commentId)
    {
        // delete like comment
        $this->likeRepo->clearLikeOrUnlikeCommentByUser($this->user->id, $commentId);
        $like = $this->likeRepo->likeCommentByUser($this->user->id, $commentId);
        return response(['data' => $like, 'status' => 200], 200);
    }

    public function unlikeComment($commentId)
    {
        // delete like comment
        $this->likeRepo->clearLikeOrUnlikeCommentByUser($this->user->id, $commentId);
        return response(['status' => 200], 200);
    }
}
