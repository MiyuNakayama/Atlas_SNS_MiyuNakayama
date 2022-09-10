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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//▼ログインしてないguestユーザーが閲覧できるページ
Route::group(['middleware' => 'guest'], function () {

//ログイン画面
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

//新規登録
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

//ようこそのページ
Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

});


//▼ログイン中のページ
//middlewareで、認証Authされているユーザーしか閲覧ができない設定にする
Route::group(['middleware' => 'auth'], function () {

Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/followlist','FollowsController@followList');

Route::get('/followerlist','FollowsController@followerList');

//ログアウト（作成中）
Route::get('/logout', 'Auth\LoginController@logout');

});
