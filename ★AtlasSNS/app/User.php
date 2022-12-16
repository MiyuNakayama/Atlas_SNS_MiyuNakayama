<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /*投稿機能、投稿の編集時に使用*/
    public function posts(){
    return $this->hasMany('App\Post');
    //Postテーブルとリレーション
}

    /*フォローするはずすの時に使用*/
    //11/28追記
    //フォロー機能のリレーション

    //自分がフォローしているユーザーを取得したい時のリレーション
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
    //引数1は使用するモデル、2は中間テーブル名、3は取得したい情報、4は余りを入れておく

    //自分のフォロワーを取得したい時のリレーション
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }
    //引数1は使用するモデル、2は中間テーブル名、3は取得したい情報、4は余りを入れておく



}
