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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Auth')->group(function () {
    Route::get('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'administrator', 'as' => 'admin.'], function () {
        Route::namespace('Admin')->group(function () {
            Route::resource('products', 'ProductController');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
