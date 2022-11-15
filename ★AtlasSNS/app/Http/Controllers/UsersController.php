<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }


    public function wordSearch(Request $request)
    {
        $request = array();
        // dd($request);
        $searchWord = $request->input('searchWord');//inputの中身は検索にかけられたsearchWordが入っているはず。。

        $query = User::query();
        dd($query);
        if(!empty($searchWord))
        {
            $searchWord->where('users.username','like','%'.$searchWord.'%');
        }
    }



}
