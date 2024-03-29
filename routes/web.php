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

Route::get('/', function () {
    return view('welcome');
});

Route::get('unauthorized', function () {
    return view('notifications.401');
})->name('unauthorized');

// Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');


/* Authorized Users */
Route::group(['middleware' => ['auth','web'],],
    function () 
{
    /* Admin Links */
    Route::group(['middleware' => ['adminOnly'],'prefix'=>'admin' ],
        function(){
            Route::resource('users','Admin\AdminController');
    });
    

}); //Middleware auth