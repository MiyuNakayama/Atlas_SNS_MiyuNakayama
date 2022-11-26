@extends('layouts.login')
@section('content')

<div id = "search-container">
<div class = "search">
  <div class = "searchArea"><!--ユーザー検索の検索窓-->
    <form action="/wordSearch" method="GET"><!--行き先のURLを指定-->
    <input type ="text" name="searchWord" placeholder ="ユーザー名">
    <input type="image" src="/images/post.png" name="searchWordButton" width="60px" hight="60px">
    </form>
  </div>
  <!--ユーザー検索③検索窓横の検索ワードの表示-->
  <div class = "searchWord">
    @if($searchWord != null)
    <h2>検索ワード：{{ $searchWord }}</h2>
    @endif
    <!--bladeに記述できるif関数。検索ワードがnullでなければsearchWordを表示する。！＝は不一致（型とか関係なくとにかく一致しない）の時。-->
  </div>
</div>

<!--ユーザー検索①全ユーザーの表示-->
<!--ユーザー検索②usersテーブルで曖昧検索をし、viewに表示-->
<!--繰り返し処理で表示させているユーザー情報は①も②も変数$usersを用いているので、表示させる部分は同一でOK-->
<div class = "allUsers-container">
@foreach ($users as $user)
  <div class = "allUsername">{{ $user->username }}</div>
  <input type="followButton" value ="フォローする">
@endforeach
</div>
</div>
@endsection
