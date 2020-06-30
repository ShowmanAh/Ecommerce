<?php

Route::get('/dashboard', function(){
    return view('dashboard.index');
 });

 Route::group(['namespace' => 'Dashboard', 'prefix'=>'dashboard'], function() {
    Route::resource('users', 'UsersController');
 });


 Auth::routes();
?>
