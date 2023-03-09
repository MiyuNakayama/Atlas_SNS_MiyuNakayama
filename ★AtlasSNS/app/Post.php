<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
/*投稿機能、投稿の編集時に使用*/
//usersテーブルとリレーション
    public function user(){
        return $this->belongsTo('App\User');
    }//Userモデルのデータを取得するよ
}
