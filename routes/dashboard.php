<?php

Route::get('/', function(){
    return view('dashboard.index');
 });
 Route::resource('/users', 'Dashboard\UsersController');

 Auth::routes();
?>
