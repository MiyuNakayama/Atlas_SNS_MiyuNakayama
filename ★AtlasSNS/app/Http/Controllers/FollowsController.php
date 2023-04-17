<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follows;
use App\User;
use Auth;
use App\Post;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
{
//11/28追記
//フォロー機能①ボタンの設置(bladeに記載)
//フォロー機能②テーブルへの登録・削除
//フォローするとき（followテーブルへの登録処理）
    public function follow(Request $request)
    {
        $user_id = Auth::user()->id;//ログインしてるユーザーの情報を取得
        $id = $request->input('id');//post送信された内容をfollowsテーブルへ
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

//**フォロー、フォロワーの表示

//自分がフォローしている人の表示
//自分がフォローしている人の呟きを表示
    public function followList()
    {
        $followList = Auth::user()->follows()->pluck('followed_id');
        //userモデルに記載されているfollowsメゾットで,followed_idを取得
        //dd($followList);
        //3456
        $follow = User::select('*')
        ->whereIn('id',$followList)
        ->get();
        //dd($follow);//色んな値は取れているidも
        $followingPosts = Post::select('*')
        ->whereIn('user_id',$followList)
        ->latest()
        ->get();

        return view('follows.followList',compact('follow','followingPosts'));
        //followsディレクトリのfollowList.bladeへ値を渡す
        //[]内で変数をviewに渡してあげないと表示ができないぞ
    }

//自分のフォロワーの表示
//自分のフォロワーの呟き表示
    public function followerList(){

        $followerList = Auth::user()->followUsers()->pluck('following_id');
        //dd($followed_id);
        //followed_idが取得出来ている

        $follower = User::select('id','username','images')
        ->whereIn('id',$followerList)
        ->get();
        $followerPosts = Post::select('*')
        ->whereIn('user_id',$followerList)
        ->latest()
        ->get();

        return view('follows.followerList',compact('follower','followerPosts'));

    }

//自分以外の人のプロフィール
//自分がフォローしている人の場合
//クリックされた画像のidを取得したい
    public function followProfile(Request $request)
    {
        //dd($request);
        $followId = $request->get('id');
        dd($followId);
        $followProfile = User::select('*')
        ->whereIn('id',$followId)
        ->get();
        //dd($followProfile);

        return view('follows.followProfile',compact('followId','followProfile'));
    }


}
