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
        Route::post('product', 'ProductController@store');
        Route::get('my-products', 'ProductController@myProducts');
        Route::post('product/{product}/comment', 'ProductCommentController@store');
        Route::post('product/{product}/report', 'ProductReportController@store');
        Route::post('product/{product}/like', 'LikeController@like');
        Route::post('comment/{comment}/like', 'LikeController@likeComment');
        Route::delete('comment/{comment}/like', 'LikeController@removeLikeComment');
        Route::post('product/{product}/bookmark', 'ProductBookmarkController@store');
        Route::delete('product/{product}/bookmark', 'ProductBookmarkController@destroy');
        Route::post('product/{product}/dislike', 'LikeController@dislike');
        Route::get('bookmark', 'BookmarkController@index');
        Route::get('user', function (Request $request) {
            return $request->user();
        });
        Route::get('user/{user}/notifications', 'UserNotificationController@index');
        Route::get('notifications', 'UserNotificationController@index');
        Route::post('set-read-notification-at', 'UserNotificationController@setReadNotification');
    });
    Route::get('product', 'ProductController@index');
    Route::get('product/nearby', 'ProductController@nearby');
    Route::get('product/{product}/comments', 'ProductCommentController@index');
    Route::get('product/{product}/reports', 'ProductReportController@index');
    Route::get('product/{slug}/{id}', 'ProductController@view');
    Route::get('report/{report}', 'ReportController@view');
    Route::post('register', 'UserController@store');
});
