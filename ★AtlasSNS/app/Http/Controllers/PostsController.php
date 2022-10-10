<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;//userモデル使用って言ってる
//↑このモデル、コントローラ使えないよってエラーが出たら、ここに書き足してあげる

class PostsController extends Controller
{
    //登録処理（ブラウザには表示されない）
    public function textCreate(Request $request){
        $user_id = Auth::user()->id;
        // 後々ユーザーアイコンも取得するのかな。。
        //ログインしてるユーザーの情報を取得
        $post = $request->input('posts');
        \DB::table('posts')->insert([
             'post' => $post,
             'user_id' => $user_id,
            //  'user_image' => $user_images
        ]);

        return redirect('/top');

    }

    //10/10追記
    public function postUser(Request $request)
    {
        $sort = $request->sort;
        $order = $request->order;

        //↓postsのuser_idと一致するusernameとidを取得する記述
        $postUser = posts::with('user:id,username')->orderBy('id', 'asc')->paginate(20);

        return view('top', ['users' => $username,]);

        }


//ブラウザに表示させる動き
    public function index(){
        $list = \DB::table('posts')->get();//postsから情報取りに行っている
        return view('posts.index',['list'=>$list]);
        }

}
