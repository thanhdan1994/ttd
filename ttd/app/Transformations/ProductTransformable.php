<?php

namespace App\Transformations;

use App\Product;

trait ProductTransformable
{
    /**
     * Transform the product
     *
     * @param Product $product
     * @return Product
     */
    protected function transformProduct(Product $product)
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
        $pst->like = count($product->like);
        $pst->unlike = count($product->unlike);
        $pst->phone = $product->phone;
        $pst->created_at = $product->created_at;
        $pst->updated_at = $product->updated_at;
        return $pst;
    }
}
