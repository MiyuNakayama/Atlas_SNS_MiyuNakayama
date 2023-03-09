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


///*投稿機能、投稿の編集時に使用*/
    public function posts()
    {
    return $this->hasMany('App\Post');//Postテーブルとリレーション
    }

///*フォローする・はずす時に使用*/
    //11/28追記
    //**フォロー機能のリレーションメゾット
    //リレーションメゾットは、テーブルに繋がっているモデルに記入する

    //↓自分のフォロワーを取得したい時のリレーション
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }
    //引数1は使用するモデル、2は中間テーブル名、3は取得したい情報、4は余りを入れておく


    //↓自分がフォローしているユーザーを取得したい時のリレーション
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
    //引数1は使用するモデル、2は中間テーブル名、3は取得したい情報、4は余りを入れておく


    //12/18追記
    //**判別するメゾット
    //自分がフォローしているかどうか確かめる。→している場合、followsテーブルのfollowed_idに一致する値がある

    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()
        ->where('followed_id', $user_id)
        ->exists();
    }
    //booleanはブール値。変数の型で、trueかfalseしか入らないらしい。thisで、このページにあるメゾットに飛ぶように指定できる
    //whereで指定したカラムと変数が一致していたら、firstで値を取得する


    // 自分がフォローされているかどうか確かめる。→されている場合、followsテーブルのfollowing_idに一致する値がある
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()
        ->where('following_id', $user_id)
        ->first();
    }

}
