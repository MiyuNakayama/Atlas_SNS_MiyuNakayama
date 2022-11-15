<?php

namespace App\Http\Controllers;

//↓このモデル、コントローラ使えないよってエラーが出たら、ここに書き足してあげる
use Illuminate\Http\Request;
use Auth;
use App\User;//userモデル使用って言ってる
use App\Post;//Postモデル使用って言ってる
//10/22追記
use Illuminate\Support\Facades\Validator;//RegisterControllerに記載があったまま流用


class PostsController extends Controller
{
    //新規投稿時のバリデーション設定
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'posts' => 'required|string|max:150',
        ]);
    }

    //登録処理（ブラウザには表示されない）
    public function textCreate(Request $request){

        //10/22追加
        $data = $request->input();//ここで$dateを定義してあげないと、->validator($data);で$data使えない
//dd($data);OK
        $validator = $this->validator($data);
            if ($validator->fails()){
                return redirect('top')//バリデーションに引っ掛かると再度/topが読み込まれるようになっている
                ->withErrors($validator)
                ->withInput();
                //$validator = $this->validator($data);の$validatorは、一旦記述してあげないとエラーが出てしまうので記述する。
                //ここまで
            }

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

//投稿内容をブラウザに表示させる動き
    public function index(){
        //リレーション
        $list = Post::with("user")->get();//postmodelに書かれている、userメゾットも一緒に情報を取得する
//dd($list);
        return view('posts.index',['list'=>$list]);
        }

//update-form(投稿内容の編集・更新)
        public function updateForm($id){
        $post = \DB::table('posts')
            ->where('id', $id)
            //$idの変数名は、ルーティング上の{id}と同じ名前にする。$numberなら{number}など。など。。
            ->first();
        return view('posts.updateForm', compact('post'));
    }
//投稿編集③web.phpで指定されたメゾットへ。modalで編集した投稿内容をrequestで取得し、idとupPostに振り分ける
    public function update(Request $request)
    {
        // dd($request);
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );//->update[]ここでDBの内容を更新している！

        return redirect('top');
    }

    //投稿削除③
    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('top');
    }

    }
