<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        //次はこっからだよ〜$listのやつ
        $list = \DB::tabel('users')->get();
        return view('posts.index',['list'=>$list]);
    }
}
