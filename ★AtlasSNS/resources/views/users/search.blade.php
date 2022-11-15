@extends('layouts.login')
@section('content')

<div class ="searchArea">

  <!--ユーザー検索の検索窓-->
  <form action="/wordSearch" method="GET"><!--行き先のURLを指定-->
    <input type ="text" name="searchWord" placeholder ="ユーザー名">
    <input type="image" src="/images/post.png" name="searchWordButton" width="60px" hight="60px">
  </form>

@foreach ($list as $list)
<div>
  
</div>
@endforeach

</div>

@endsection
