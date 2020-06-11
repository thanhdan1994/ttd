<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-products-nearby', function (Request $request) {
    $lat = $request->get('lat');
    $long = $request->get('long');
    $string = "SELECT id, name, phone, address, amount, excerpt, featured_image,
                      ST_Distance(
                         POINT(?,?),
                         POINT(products.lat,products.long)
                      ) as distance
                FROM products
                ORDER BY distance ASC
                LIMIT 0, 20";
    $products = \Illuminate\Support\Facades\DB::select($string, [$lat, $long]);
    foreach ($products as $key => $product) {
        $thumbnailUrl = \App\Product::find($product->id)->thumbnailUrl;
        $product->thumbnail = $thumbnailUrl;
    }
    return ($products) ? $products : null;
});
