<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['following_user_id', 'followed_user_id'];
    protected $table = 'follows';

    /*フォローする・はずすの時に使用*/
    //11/28追記
    //フォロー機能のリレーション

    //↓自分がフォローしているユーザーを取得したい時のリレーション
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
    //引数1は使用するモデル、2は中間テーブル名、3は取得したい情報、4は余りを入れておく

    //↓自分のフォロワーを取得したい時のリレーション
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }
    //引数1は使用するモデル、2は中間テーブル名、3は取得したい情報、4は余りを入れておく

//12/18追記
    // 自分がフォローしているか
    // している場合、followsテーブルのfollowed_idに一致する値がある
    //判別するメゾット
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()
        //booleanはブール値。変数の型で、trueかfalseしか入らないらしい
        ->where('followed_id', $user_id)
        //whereで指定したカラムと変数が一致していたら、firstで値を取得する
        ->first(['id']);
    }

    // 自分がフォローされているか
    // されている場合、followsテーブルのfollowing_idに一致する値がある
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

}
