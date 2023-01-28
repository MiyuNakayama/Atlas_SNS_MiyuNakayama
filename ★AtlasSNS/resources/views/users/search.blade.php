@extends('layouts.login')
@section('content')

<div id = "search-container">
  <div class = "search">
    <div class = "searchArea"><!--ユーザー検索の検索窓-->
    <form action="/wordSearch" method="GET"><!--行き先のURLを指定-->
    <input type ="text" name="searchWord" placeholder ="ユーザー名">
    <input type="image" src="/images/post.png" name="searchWordButton" width="60px" hight="60px">
    </form>
    <!--ユーザー検索③検索窓横の検索ワードの表示-->
    <div class = "searchWord">
      @if( isset($searchWord) )
      <!--bladeに記述できるif関数。検索ワードが存在すればsearchWordを表示する。-->
  <h2>検索ワード：{{ $searchWord }} </h2>
  @endif
    </div>
  </div>
</div>

<!--ユーザー検索①全ユーザーの表示-->
<!--ユーザー検索②usersテーブルで曖昧検索をし、viewに表示-->
<div class = "allUsers-container">
@foreach ($users as $user)
  <div class = "allUsername">{{ $user->username }}</div>

  <!-- フォロー機能①フォローする、フォローを外すボタンの設置 -->
  <!-- どちらのボタンも作成し、その後正しい方を表示させる！ -->

<!--if(条件①ログインユーザーのidが、following_idと一致 && followed_idが、$user->idと一致)else(条件①以外の場合)-->
@if(Auth::user()->isFollowing($user->id))
<form action="/unFollow" method ="POST">
  <input type ="submit" name ="follow" value ="フォロー解除する">
  <input type="hidden" name="id" value= "{{$user->id}}" class="followsButton">
{{ csrf_field() }}
</form>
@else
<form action="/follow" method ="POST">
  <input type ="submit" name ="follow" value ="フォローする" >
  <input type="hidden" name="id" value= "{{$user->id}}" class="followsButton">
{{ csrf_field() }}
</form>
@endif

@endforeach
<!--繰り返し処理で表示させているユーザー情報は①も②も変数$usersを用いているので、表示させる部分は同一でOK-->
</div>
</div>
@endSection
