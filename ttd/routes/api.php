<?php

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $product->link = route('admin.products.show', $product->id);
    }
    return ($products) ? $products : null;
});

Route::post('/comment/create', function (Request $request) {
    if (empty($request->get('content'))) {
        return ['status' => false, 'message' => 'nội dung bình luận không được rỗng', 'data' => false];
    }
    if (empty($request->get('product_id')) || empty($request->get('user_id'))) {
        return ['status' => false, 'message' => 'thiếu tham số product_id hoặc user_id', 'data' => false];
    }
    $data = $request->all();
    DB::beginTransaction();
    try {
        $comment = Comment::create($data);
    } catch (\Exception $exception) {
        DB::rollBack();
        return [
            'status' => false,
            'message' => 'Có lỗi hệ thông trong quá trình thêm mới bình luận' . $exception->getMessage(),
            'data' => false
        ];
    }
    DB::commit();
    $comment->author_name = $comment->user->name;
    $comment->author_avatar = $comment->user->thumbnailUrl;
    return ['status' => true, 'message' => 'Thêm bình luận thành công', 'data' => $comment];
})->name('api.comment.create');
