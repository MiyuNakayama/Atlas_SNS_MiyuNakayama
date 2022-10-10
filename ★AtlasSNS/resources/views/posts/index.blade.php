@extends('layouts.login')

@section('content')
<div class="newpost">
  <img src="/images/icon4.png">
  <form action="/text/create" method="post">
    @csrf
    <!--↑↑行き先のURLを記述↑↑-->
    <textarea name='posts' value placeholder="投稿内容を入力してください"></textarea>
    <input type="image" src="/images/post.png" name="postsbuttom" width="60px" heigth="60px"><!--アイコンの大きさ直接指定-->
  </form>
</div>

<div class="postsarea"></div>
<!--ここら辺にアイコンがありそう-->
<!--投稿された時刻表示もあるよ-->
<div>
  <table class='posts'>
            <!-- <tr>
                <th>投稿No</th>
                <th>投稿内容</th>
                <th>投稿日時</th>
            </tr> -->
            @foreach ($list as $list)
            <tr>
                <td>{{ $list->created_at }}</td>
                <td>{{ $list->post }}</td>
                <!-- 10/10追記-->
                <td>{{ $postUser->user->username }}</td>
                <!--秒数いらんなあ--></td>
            </tr>
            @endforeach
        </table>
</div>
@endsection
