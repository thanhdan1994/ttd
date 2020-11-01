<?php
use Illuminate\Http\Request;

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

Route::post('login', [\Laravel\Passport\Http\Controllers\AccessTokenController::class, 'issueToken'])
    ->middleware(['api-login', 'throttle']);

Route::get('login/google', 'Auth\LoginController@redirectToProvider')->middleware('web');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback')->middleware('web');
Route::get('login/social/redirect', function (Request $request) {
    return redirect('/')->withCookie(cookie(
        'access_token',
        $request->access_token,
        0,
        '/',
        null,
        null,
        false
    ));
});

Route::namespace('Api')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('product', 'ProductController@createProduct');
        Route::get('my-products', 'ProductController@myProducts');
        Route::get('my-bookmark', 'ProductController@myBookmark');
        Route::post('product/{product}/comment', 'ProductCommentController@store');
        Route::post('product/{product}/report', 'ProductReportController@store');
        // like/dislike product
        Route::post('product/{productId}/like', 'LikeController@likeProduct');
        Route::post('product/{productId}/dislike', 'LikeController@dislikeProduct');
        // like/unlike comment
        Route::post('comment/{commentId}/like', 'LikeController@likeComment');
        Route::delete('comment/{commentId}/unlike', 'LikeController@unlikeComment');
        // bookmark/unbookmark
        Route::post('product/{product}/bookmark', 'ProductBookmarkController@bookmark');
        Route::delete('product/{product}/unbookmark', 'ProductBookmarkController@unbookmark');
        Route::get('user', function (Request $request) {
            return $request->user();
        });
        Route::get('notifications', 'NotificationController@listNotificationsByUserLogged');
        Route::post('set-read-notification-at', 'NotificationController@setReadNotification');
    });
    Route::get('categories/{id}/products', 'CategoryProductController@index');
    Route::get('categories', 'CategoryController@index');
    Route::get('product', 'ProductController@getProducts');
    Route::get('product/nearby', 'ProductController@nearby');
    Route::get('product/{productId}/comments', 'ProductCommentController@getCommentsOfProduct');
    Route::get('product/{product}/reports', 'ProductReportController@index');
    Route::get('product/{slug}/{id}', 'ProductController@detailProduct');
    Route::get('report/{report}', 'ReportController@view');
    Route::post('register', 'UserController@store');
});
