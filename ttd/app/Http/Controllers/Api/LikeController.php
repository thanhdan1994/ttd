<?php
namespace App\Http\Controllers\Api;

use App\Comment;
use App\Events\LikeComment;
use App\Events\Test;
use App\Http\Controllers\Controller;
use App\Like;
use App\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, Product $product)
    {
        $user_id = $request->user()->id;
        Like::where([
            'model_type' => get_class($product),
            'model_id' => $product->id,
            'user_id' => $user_id
        ])->delete();
        $like = Like::create([
            'model_type' => get_class($product),
            'model_id' => $product->id,
            'user_id' => $user_id,
            'type' => 1
        ]);
        return response(['data' => $like, 'status' => 200], 200);
    }

    public function dislike(Request $request, Product $product)
    {
        $user_id = $request->user()->id;
        Like::where([
            'model_type' => get_class($product),
            'model_id' => $product->id,
            'user_id' => $user_id
        ])->delete();
        $unlike = Like::create([
            'model_type' => get_class($product),
            'model_id' => $product->id,
            'user_id' => $user_id,
            'type' => 2,
        ]);
        return response(['data' => $unlike, 'status' => 200], 200);
    }

    public function likeComment(Comment $comment, Request $request)
    {
        $user_id = $request->user()->id;
        Like::where([
            'model_type' => get_class($comment),
            'model_id' => $comment->id,
            'user_id' => $user_id
        ])->delete();
        $like = Like::create([
            'model_type' => get_class($comment),
            'model_id' => $comment->id,
            'user_id' => $user_id,
            'type' => 1
        ]);
        event(new LikeComment($like->author->name . ' Đã thích bình luận của bạn', $comment->author->id));
        return response(['data' => $like, 'status' => 200], 200);
    }

    public function removeLikeComment(Comment $comment, Request $request)
    {
        $user_id = $request->user()->id;
        $like = Like::where([
            'model_type' => get_class($comment),
            'model_id' => $comment->id,
            'user_id' => $user_id
        ])->delete();
        return response(['data' => $like, 'status' => 200], 200);
    }
}
