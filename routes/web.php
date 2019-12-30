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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/profile', function () {
//     return view('profile');
// });

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('home', 'HomeController@index')->name('home');

Route::get('/', 'UserController@show')->name('welcome');
Route::get('user/{id}', 'UserController@user')->name('user');


// User profile

Route::patch('profile/{id}/update', 'UserController@update')->name('profile');
Route::get('profile/', 'UserController@profile')->name('profile');


Route::get('/like/{id}', 'LikeController@like')->name('like');

