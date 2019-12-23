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

Route::resource('product', 'SiteController');
Route::post('/cart/add', [
    'uses' => 'ShoppingController@add_to_cart',
    'as' => 'cart.add'
]);
Route::get('/cart/firstAdd/{id}', [
    'uses' => 'ShoppingController@firstAdd',
    'as' => 'cart.firstAdd'
]);
Route::get('/cart',[
    'uses' => 'ShoppingController@cart',
    'as' => 'cart'
] );
Route::get('cart/delete/{id}', [
    'uses' => 'ShoppingController@delete_cart',
    'as' => 'cart.delete'

]);
Route::get('cart/increment/{id}/{qty}', [
    'uses' => 'ShoppingController@increment',
    'as' => 'cart.increment'

]);
Route::get('cart/decrement/{id}/{qty}', [
    'uses' => 'ShoppingController@decrement',
    'as' => 'cart.decrement'

]);
//Route::post('/cart/add', 'ShoppingController@add_to_cart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('products', 'ProductController');
