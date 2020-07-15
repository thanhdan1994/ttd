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
        try {
            $bookmark->user_id = $request->user()->id;
            $bookmark->product_id = $product->id;
            $bookmark->save();
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response($bookmark,200);
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
        try {
            $bookmark = Bookmark::where([
                'product_id' => $product->id,
                'user_id' => $request->user()->id
            ])->firstOrFail();
            $bookmark->delete();
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response(null, 200);
    }
}
