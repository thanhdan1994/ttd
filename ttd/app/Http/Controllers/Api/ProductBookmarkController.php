<?php

namespace App\Http\Controllers\Api;

use App\Bookmark;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductBookmarkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \App\Bookmark
     */
    public function store(Request $request, Product $product)
    {
        $bookmark = new Bookmark;
        $bookmark->user_id = $request->user()->id;
        $bookmark->product_id = $product->id;
        if ($bookmark->save()) {
            return response($bookmark,200);
        }
        return response(['message' => 'không thể bookmark'],400);
    }

    /**
     * Destroy a Bookmark created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \App\Bookmark
     */
    public function destroy(Request $request, Product $product)
    {
        $bookmark = Bookmark::where([
            'product_id' => $product->id,
            'user_id' => $request->user()->id
        ])->first();
        return response($bookmark->delete());
    }
}
