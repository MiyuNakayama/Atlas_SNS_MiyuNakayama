<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follows;
use Auth;

class UsersController extends Controller
{
    //ユーザー検索①検索前の全ユーザーの表示
    public function search(){
        $users = User::get();

        //必ずviewファイルに値をおくってあげる
        return view('users.search',['users'=>$users]);
    }

//ユーザー検索②usersテーブルで曖昧検索をし、viewに表示
//ユーザー検索③検索したワードの表示
//②と同様のメゾットを使用する
    public function wordSearch(Request $request)
    {
        //dd($request);
        $searchWord = $request->input('searchWord');
        //inputされた中身は検索にかけられたsearchWordが入っているはず。。
        //dd($searchWord);

        if(isset($searchWord))
        {
            $users = User::where('username','like','%'.$searchWord.'%')->get();
            //検索かけたら必ずget()して、結果の値を変数にぶち込みます
            //dd($users);
        }
        else
        {
            $users = User::get();//検索して該当するユーザーがない場合は再度全選択する
        }
        //②の検索結果で使うusersと、③の上記で使うsearchWordを同時にviewに渡す
         return view('users.search',['users'=> $users,'searchWord'=> $searchWord]);
         //検索前に送った変数$usersと、検索後の変数$users
    }

//自分のプロフィールの表示
    public function profile()
    {
        return view('users.profile');
    }

//プロフィールの更新
    public function profileUpdate(Request $request)
    {
        $profileUpdate = $request->input('users');
        dd($request);
        \DB::table('users')->insert([
            'edit_userName' => $username,
            'edit_mailAdress' => $mail,
            'edit_bio' => $bio
        ]);
            return redirect('/top');
    }


//自分のプロフィール画像の表示
    public function upimg(Request $request)
    {
        $dir = 'images';
        //保存先のディレクトリを指定

        $fileName = $request->file('image')->getClientOriginalName();
        //画像の名前を取得
        $profileUpdate = $request->file('image')->store('public/' . $dir,$fileName);
        //取得した画像の名前で指定したディレクトリに保存される

        return view('posts.index');
        // return redirect('/');
    }


}
