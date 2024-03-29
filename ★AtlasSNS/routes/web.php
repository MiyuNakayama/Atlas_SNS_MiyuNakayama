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
//top表示のためのルーティング
Route::get('/top','PostsController@index');

//1/23追記
//フォロワー数の表示
//URLの指定謎。
Route::get('/index','FollowsController@Follower');
//Route::get('/followList','FollowsController@FollowList');

//▼自分のプロフィール表示のためのルーティング
Route::get('/profile','UsersController@profile');
//プロフィールの更新
Route::post('/profile/Update','UsersController@profileUpdate');

//▼フォロー、フォロワーのリスト表示のルーティング
Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

//▼自分以外のuserのプロフィール表示
Route::get('/followProfile/{id}','FollowsController@followProfile');

//▼新規投稿のルーティングをかく！
///text/createは、ブラウザ表示URLではなく、投稿内容登録に使うメゾット名
Route::post('/text/create', 'PostsController@textCreate');

//10/10追記
//ブラウザに表示させる動き
//postメゾットに書かれている、userメゾットも一緒に情報を取得するよ
Route::post('/post/user', 'PostsController@postUser');

//10/22追記
//投稿内容の編集・更新
Route::get('/post/{id}/updateForm', 'PostsController@updateForm');

//11/8追記
//投稿編集②formでおくされてきた投稿内容を処理するメゾットを決める。PostsControllerへ行くよ
Route::post('/update','PostsController@update');

//11/8追記
//投稿の削除
Route::get('/post/{id}/delete', 'PostsController@delete');

//11/17追記
//ユーザー検索①ページの全ユーザーの表示
Route::get('/search','UsersController@search');

//11/12追記
//ユーザー検索②DBから曖昧検索されたワードを探す
//ユーザー検索③検索窓横の検索ワードの表示
Route::get('/wordSearch','UsersController@wordSearch');

//11/28追記
//**フォロー機能
///search.bladeでフォローする
Route::post('/follow','FollowsController@follow');
//12/18追記
///search.bladeでフォロー外す
Route::post('/unFollow','FollowsController@unFollow');
///ここでどっちのページでも使えるようにする

// ///followProfile.bladeでフォローする
// Route::post('/profileFollow','FollowsController@profileFollow');
// ///followProfile.bladeでフォロー外す
// Route::post('/profileUnFollow','FollowsController@profileUnFollow');

});

//ログアウト（作成中）
Route::get('/logout', 'Auth\LoginController@logout');
