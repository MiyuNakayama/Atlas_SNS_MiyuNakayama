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

<div>
</div>

<div class ="listIcon">
  <h2>FollowList:アイコン一覧</h2>
  <div class="listIcon">
  @foreach($follow as $follow)
<a href ="/followProfile/{{ $follow -> id }}">
  <img src="{{ asset($follow -> images) }}" ></a>
  @endforeach
  </div>
</div>

<div class = "listPosts">
  @foreach( $followingPosts as $followingPosts )

<div class="postsIcon">
    <a href="/followProfile/{{ $follow -> id }}"><img src="{{ asset($follow -> images) }}" ></a>
  </div>

  <div class="followPosts">
    <h2>名前：{{ $followingPosts->user->username }}</h2>
    <h2>投稿内容：{{ $followingPosts->post }}</h2>
    <h2>投稿時刻：{{ $followingPosts->updated_at }}</h2>
  </div>

  @endforeach
</div>

@endsection
