@extends('layouts.login')
@section('content')

<div class = "search">
  <div class = "searchArea">
  <!--ユーザー検索の検索窓-->
    <form action="/wordSearch" method="GET"><!--行き先のURLを指定-->
    <input type ="text" name="searchWord" placeholder ="ユーザー名">
    <input type="image" src="/images/post.png" name="searchWordButton" width="60px" hight="60px">
    </form>
  </div>

  <!--ユーザー検索③検索窓横の検索ワードの表示-->
  <div class = "searchWord">
    <h2>検索ワード：{{ $searchWord }}</h2>
</div>

</div>

<!--ユーザー検索①全ユーザーの表示-->
<!--ユーザー検索②usersテーブルで曖昧検索をし、viewに表示-->
@foreach ($users as $user)
<!--繰り返し処理で表示させているユーザー情報は①も②も変数$usersを用いているので、表示させる部分は同一でOK-->
<div class = allUsers>
  <div class = AllUsername>{{ $user->username }}</div>
</div>
@endforeach
@endsection
