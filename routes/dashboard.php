<?php



 Route::group(['namespace' => 'Dashboard', 'prefix'=>'dashboard'], function() {
    Route::resource('users', 'UsersController');
    Route::resource('categories', 'CategoryController');
    Route::resource('books', 'BookController');
    Route::get('/', 'DashboardController@index');
 });


 Auth::routes();
?>
