<?php
namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Like;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductCommentController extends Controller
{
    public function index(Product $product, Request $request)
    {
        $size = 5;
        if ($request->size) {
            $size = $request->size;
        }
        $comments = Comment::where([
            'product_id' => $product->id,
            'parent' => 0,
            'status' => 1
        ])->withCount(['like', 'unlike'])->orderBy('created_at', 'desc')->paginate($size);
        $data['total_pages'] = $comments->lastPage();
        $data['current_page'] = $comments->currentPage();
        $data['per_page'] = $comments->perPage();
        $data['total'] = $comments->total();
        $comments = $comments->map(function (Comment $comment) {
            $user = auth('api')->user();
            $like = false;
            if (!empty($user)) {
                $like = Like::where([
                    'user_id' => $user->id,
                    'type' => 1,
                    'model_type' => get_class($comment),
                    'model_id' => $comment->id
                ])->first() ? true : false;
            }
            $comment->like = $like;
            $comment->timeAgo = time_elapsed_string_vi($comment->created_at);
            $comment->author;
            $comment->child->map(function (Comment $comment) {
                $user = auth('api')->user();
                $like = false;
                $comment->like_count = $liked = Like::where([
                    'type' => 1,
                    'model_type' => get_class($comment),
                    'model_id' => $comment->id
                ])->count();
                if (!empty($user)) {
                    $like = Like::where([
                        'user_id' => $user->id,
                        'type' => 1,
                        'model_type' => get_class($comment),
                        'model_id' => $comment->id
                    ])->first() ? true : false;
                }
                $comment->like = $like;
                $comment->timeAgo = time_elapsed_string_vi($comment->created_at);
                $comment->author;
                return $comment;
            });
            return $comment;
        });
        $data['data'] = $comments;
        return response($data, 200);
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
