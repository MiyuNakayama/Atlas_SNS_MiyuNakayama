<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follows;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

//11/28追記
//フォロー機能①ボタンの設置


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
        $user_id = Auth::user()->id;
        //dd($user_id);
        //ログインしてるユーザーの情報を取得
        $followed_id = $request->input('id');
        //post送信された内容をfollowsテーブルへ
//dd($followed_id);
        \DB::table('follows')
        ->where('followed_id', $followed_id)
        //前者がカラム名で、後者が解除したい人のid
        ->where('following_id', $user_id)
        //2つ目の条件がないと、1つ目の条件が一致してるもの全部消える笑
        ->delete();

        return redirect('/search');
    }
}
