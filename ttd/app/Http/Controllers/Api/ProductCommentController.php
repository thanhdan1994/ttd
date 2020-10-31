<?php
namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\ApiController;
use App\Like;
use App\Product;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param  \App\Product $product
     * @return \Illuminate\View\View
     */
    public function store(Request $request, Product $product)
    {
        $messages = [
            'content' => 'Địa chỉ email này đã tồn tại',
        ];
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ], $messages);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['product_id'] = $product->id;
        $data['parent'] = $request->parent ? $request->parent : 0;
        DB::beginTransaction();
        try {
            $comment = Comment::create($data);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response(['message' => $exception->getMessage()], 400);
        }
        DB::commit();
        return response($comment, 200);
    }
}
