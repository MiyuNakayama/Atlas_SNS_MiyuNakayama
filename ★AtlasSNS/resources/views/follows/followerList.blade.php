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

<div class="listIcon">
  <h2>FollowerList:アイコン一覧</h2>
  <div class="listIcon">
    @foreach ( $follower  as $follower )
    <a href="/followProfile/{{ $follower -> id }}">
      <img src="{{ asset($follower -> images) }}" ></a>
      @endforeach
  </div>
</div>

<div class="listPosts">
  @foreach ( $followerPosts as $followerPosts )

  <div class="postsIcon">
    <a href="/followProfile/{{ $follower -> id }}"><img src="{{ asset($follower -> images) }}" ></a>
  </div>

  <div class="followerPosts">
    <h2>名前：{{ $follower->username }}</h2>
    <h2>投稿内容：{{ $followerPosts->post }}</h2>
    <h2>投稿時刻：{{ $followerPosts->updated_at }}</h2>
  </div>

  @endforeach
</div>

@endsection
