<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Auth')->group(function () {
    Route::get('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'administrator', 'as' => 'admin.'], function () {
        Route::namespace('Admin')->group(function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::get('/products/nearby', 'ProductController@nearby')->name('products.nearby');
            Route::get('/products/me', 'ProductController@me')->name('products.me');
            Route::get('/bookmarks/me', 'BookmarkController@me')->name('bookmarks.me');
            Route::resource('products', 'ProductController');
            Route::resource('categories', 'CategoryController');
            Route::resource('products.reports', 'ProductReportController');
            Route::resource('products.comments', 'ProductCommentController');
            Route::resource('products.bookmarks', 'BookmarkController')->shallow();
        });
    });
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/nearby', 'HomeController@index')->name('home.index');
Route::get('/bookmarks', 'HomeController@index')->name('home.index');
Route::get('/my-products', 'HomeController@index')->name('home.index');
Route::get('/{slug}/{id}', 'HomeController@index')->name('home.index');
