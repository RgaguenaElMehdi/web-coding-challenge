<?php

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //only authorized users can access these routes
    /*Route::get('/', function () {
        return view('welcome');
    });*/
    //api data
    //datat register
    Route::get('/like/{id}', 'ShopController@storelike')->name('like');
    Route::get('/dislike/{id}', 'ShopController@dislike')->name('dislike');

});

Route::group(['middleware' => ['guest']], function () {

});

Route::get('/shop', 'ShopController@index');
Route::get('/liked', 'ShopController@liked');
//showing page
Route::get('/', 'ShopController@show')->name('shop');
Route::get('/prefshops', 'ShopController@likedshop')->name('pref');

//remove liked hsop
Route::get('/{id}', 'ShopController@destroy');



Route::get('/home', 'HomeController@index')->name('home');
