<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Like;
use App\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user_id = $request->user()->id;
        $product = Product::find($request->id);
        if (empty($product)) {
            return response(['message' => 'San pham khong ton tai', 'status' => 404], 400);
        }
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

    public function dislike(Request $request)
    {
        $user_id = $request->user()->id;
        $product = Product::find($request->id);
        if (empty($product)) {
            return response(['message' => 'San pham khong ton tai', 'status' => 404], 400);
        }
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
}
