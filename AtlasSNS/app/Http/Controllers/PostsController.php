<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
      //だよ〜$listのやつ
        $list = \DB::table('users')->get();
        return view('posts.index',['list'=>$list]);
    }
}
