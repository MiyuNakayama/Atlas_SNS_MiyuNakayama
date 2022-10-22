@extends('layouts.login')

@section('content')
<div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>

<div class="newPost">
  <img src="/images/icon4.png">
  <form action="/text/create" method="post">
    @csrf
    <!--↑↑行き先のURLを記述↑↑-->
    <textarea name='posts' value placeholder="投稿内容を入力してください"></textarea>
    <input type="image" src="/images/post.png" name="postsButton" width="60px" hight="60px"><!--アイコンの大きさ直接指定-->
  </form>
</div>

<div id= "postsArea" >
<div class = "flexbox">
  <table class="posts">
            @foreach ($list as $list)
            <!--ここら辺にアイコンがありそう-->
              <div class = display-container>
                <div class = postUsername>{{ $list->user->username }}</div><!--$listに収められている情報->user（メゾット名）->username（カラム名）-->
                <div class = postCreated_at>{{ $list->created_at }}</div>
              </div>

                <p class = postPost>{{ $list->post }}</p>

                <div class= "postButtons">
                  <a href="/post/{{$list->id}}/update-form">
                    <input type="image" src="/images/edit.png" name="editButton" width="30px" hight="30px">
                  </a>
                  <a href="/post/{{$list->id}}/delete">
                    <!--削除機能はこれから書くうううう-->
                    <input type="image" src="/images/trash.png" name="trashButton" width="30px" hight="30px">
                  </a>
                </div>
            @endforeach
        </table>
</div>
</div>
@endsection
