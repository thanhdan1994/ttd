<?php

namespace App\Transformations;

use App\Comment;
use App\Like;
use App\Product;

trait ProductTransformable
{
    /**
     * Transform the product
     *
     * @param Product $product
     * @param $user
     * @return Product
     */
    protected function transformProduct(Product $product, $user = null)
    {
        $pst = new Product;
        $pst->id = (int)$product->id;
        $pst->category = $product->category;
        $pst->slug = $product->slug;
        $pst->name = $product->name;
        $pst->excerpt = $product->excerpt;
        $pst->address = $product->address;
        $pst->content = $product->content;
        $pst->amount = $product->amount;
        $pst->thumbnail = $product->thumbnailUrl;
        $images = [];
        foreach ($product->images as $key => $image) {
            $images[$key]['thumb'] = $image->getUrl('thumb');
            $images[$key]['origin'] = $image->getUrl();
        }
        $pst->images = $images;
        $pst->infomation = json_decode($product->properties);
        $comment = Comment::where([
            'product_id' => $product->id,
            'parent' => 0,
            'status' => 1
        ])->withCount(['like', 'unlike'])->orderBy('created_at', 'desc')->first();
        $like = false;
        if ($user) {
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
        $pst->comment = $comment;
        $pst->comment_count = count($product->comments);
        $pst->like = count($product->like);
        $pst->unlike = count($product->unlike);
        $pst->phone = $product->phone;
        $pst->created_at = $product->created_at;
        $pst->updated_at = $product->updated_at;
        return $pst;
    }
}
