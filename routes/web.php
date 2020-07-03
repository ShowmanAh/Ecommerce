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

/*
Route::get('/', function () {
    return view('index');
});
*/

Route::get('dashboard', function(){
   return view('dashboard.index');
});
//Route::post('/cart/add', 'ShoppingController@add_to_cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Site'], function () {
    Route::get('/', [
       'uses' => 'SiteController@index',
       'as' => 'site.books',
    ]);
    Route::get('/book/{id}', [
        'uses' => 'SiteController@show',
        'as' => 'book.show'
    ]);
    Route::post('/cart/add',
   [
       'uses' => 'CartController@add_to_cart',
       'as' => 'cart.add',
       ]
    );
    Route::get('cart', [
       'uses' =>'CartController@cart',
       'as' => 'site.cart',
    ]);
    Route::get('cart/delete/{id}', [
        'uses' => 'CartController@delete_cart',
        'as' => 'cart.delete'

    ]);
    Route::get('cart/increment/{id}/{qty}', [
        'uses' => 'CartController@increment',
        'as' => 'cart.increment'

    ]);
    Route::get('cart/decrement/{id}/{qty}', [
        'uses' => 'CartController@decrement',
        'as' => 'cart.decrement'

    ]);
    Route::get('cart/checkout', [
        'uses' => 'CheckoutController@index',
        'as' => 'cart.checkout'

    ]);
    Route::post('cart/checkout', [
        'uses' => 'CheckoutController@puy',
        'as' => 'cart.checkout'

    ]);
    Route::get('/cart/firstAdd/{id}', [
        'uses' => 'CartController@firstAdd',
        'as' => 'cart.firstAdd'
    ]);
});


