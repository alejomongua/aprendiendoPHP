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

/* Rutas públicas */
Route::get('/', 'App\Http\Controllers\MainController@index')->name('root');

Auth::routes();
/* Fin rutas públicas */

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'App\Http\Controllers\MainController@home')->name('home');
  Route::resource('users', 'App\Http\Controllers\UserController');
  Route::get('/edit-my-profile', 'App\Http\Controllers\UserController@editMyProfile')->name('editMyProfile');
  Route::get('/view-my-profile', 'App\Http\Controllers\UserController@viewMyProfile')->name('viewMyProfile');
  Route::get('/users/{image_id}/convert-in-profile', 'App\Http\Controllers\UserController@convertInProfile')->name('users.convertInProfile');

  Route::resource('images', 'App\Http\Controllers\ImagesController');
  Route::get('/images/{id}/get', 'App\Http\Controllers\ImagesController@get')->name('images.get');

  Route::get('likes/{imageId}', 'App\Http\Controllers\LikeController@store')->name('like');
});
