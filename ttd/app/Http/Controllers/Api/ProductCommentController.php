<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use Illuminate\Http\Request;

class ProductCommentController extends ApiController
{
    private $likeRepo;

    private $commentRepo;

    public function __construct(
        LikeRepositoryInterface $likeRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        parent::__construct();
        $this->likeRepo = $likeRepository;
        $this->commentRepo = $commentRepository;
    }

    public function getCommentsOfProduct($productId, Request $request)
    {
        $size = $request->size ? : 5;
        $page = $request->page ? : 1;
        $comments = $this->commentRepo->listCommentsWithCountLikeAndUnlike(
            [
                'product_id' => $productId,
                'parent' => 0,
                'status' => 1
            ],
            $page,
            $size,
            'created_at',
            'desc'
        );
        $comments = $comments->map(function ($comment) {
            $like = false;
            if (!empty($user)) {
                $like = $this->likeRepo->isCommentLikedByUser($this->user->id, $comment->id);
            }
            $comment->like = $like;
            $comment->timeAgo = time_elapsed_string_vi($comment->created_at);
            $comment->author;
            $comment->child->map(function ($comment) {
                $user = auth('api')->user();
                $like = false;
                $comment->like_count = $this->likeRepo->numberCommentLiked($comment->id);
                if (!empty($user)) {
                    $like = $this->likeRepo->isCommentLikedByUser($this->user->id, $comment->id);
                }
                $comment->like = $like;
                $comment->timeAgo = time_elapsed_string_vi($comment->created_at);
                $comment->author;
                return $comment;
            });
            return $comment;
        });
        return response($comments, 200);
    }

    public function createComment(Request $request, $productId)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;
        $data['product_id'] = $productId;
        $data['parent'] = $request->parent ? $request->parent : 0;
        try {
            $this->commentRepo->createComment($data);
        } catch (\Exception $exception) {
            return response(['message' => $exception->getMessage()], 400);
        }
        return response(['status' => 'success'], 200);
    }
}
