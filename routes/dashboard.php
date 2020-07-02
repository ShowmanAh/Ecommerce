<?php

Route::get('/dashboard', function(){
    return view('dashboard.index');
 });

 Route::group(['namespace' => 'Dashboard', 'prefix'=>'dashboard'], function() {
    Route::resource('users', 'UsersController');
    Route::resource('categories', 'CategoryController');
    Route::resource('books', 'BookController');
 });


 Auth::routes();
?>
