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
                <div class = postUsername>{{ $list->user->username }}</div><!--$listに収められている情報->user（modelに記載されているメゾット名）->username（カラム名）-->
                <div class = postCreated_at>{{ $list->created_at }}</div>
              </div>

                <p class = postPost>{{ $list->post }}</p>

                <div class= "postButtons">
                  <!--投稿編集前のデフォルトページ-->
                  <!--投稿編集button-->
                  <a class="js-modal-open" href="" post="{{ $list -> post }}" post_id="{{ $list -> id }}"><input type="image" src="/images/edit.png"
                  name="editButton" width="30px" hight="30px"></a><!--postとpost_idどちらの情報も持たせる-->

                  <!--投稿削除button-->
                  <!--投稿削除①削除ボタンをおす→はいを選択する-->
                  <a class="deleteButton" href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                    <input type="image" src="/images/trash.png" name="trashButton" width="30px" hight="30px">
                  </a>
                </div>
            @endforeach
          </table>
          </div>
        </div>

        <!--モーダルの中身-->
        <div class="modal js-modal">
          <div class="modal__bg js-modal-close"></div>
          <div class="modal__content">
            <!--投稿編集①更新内容が送られる。データはweb.phpにいくよ-->
            <form action="/update" method="post"><!--↑ここのURLの指定は自由でOK。今回は/updateにしたよ。送り方はpost送信。-->
                <textarea name="upPost" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <input type="image" src="/images/edit.png" name="editButton" width="30px" hight="30px">
                {{ csrf_field() }}
           </form>
           <a class="js-modal-close" href=""></a>
          </div>
        </div>

@endsection
