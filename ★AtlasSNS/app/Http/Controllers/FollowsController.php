<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follows;
use Auth;

class FollowsController extends Controller
{
    //**フォロー、フォロワーの表示
    public function followList(){
        return view('follows.followList');
        //followsディレクトリのfollowList.bladeへ値を渡す
    }
    public function followerList(){
        return view('follows.followerList');
    }

    // //1/23追記
    // //まずはフォロワーの数を表示したい。
    // public function follower(){
    //     $followers = Follow::get('followed_id');

    //     return redirect('/login');
    // }

//11/28追記
//フォロー機能①ボタンの設置(bladeに記載)

//フォロー機能②テーブルへの登録・削除
//フォローするとき（followテーブルへの登録処理）
    public function follow(Request $request)
    {
        $user_id = Auth::user()->id;
        //ログインしてるユーザーの情報を取得
        $id = $request->input('id');
        //post送信された内容をfollowsテーブルへ

        \DB::table('follows')->insert([
            'following_id' => $user_id,
            'followed_id' => $id
        ]);//ここでテーブルにインサートする

        return redirect('/search');
    }

//フォローはずすとき（followテーブルへの削除処理）
    public function unFollow(Request $request)
    {
        $user_id = Auth::user()->id;//ログインしてるユーザーの情報（id）を取得
        $followed_id = $request->input('id');//post送信された内容（id）をfollowsテーブルのfollowed_idへぶち込む

        //dd($followed_id);

        \DB::table('follows')
        ->where('followed_id', $followed_id)//前者がカラム名で、後者が解除したい人のidがぶち込まれたカラム名。
        ->where('following_id', $user_id)
        //なので、テーブル上でfollowed_idにfollowed_id(requestのid)が入っており、following_idにuser_idが入っているレコードが削除される。
        //2つ目のwhere（条件）がないと、1つ目の条件が一致してるもの全部消える笑
        ->delete();

        return redirect('/search');
    }
}
