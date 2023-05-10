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

<div>
  <h2>FollowerList:アイコン一覧</h2>
  @foreach ( $follower  as $follower )
  <form action="/followProfile" method="post">
    @csrf
    <input type="hidden" name="followId" value="{{  $follower -> id }}">
    <button id = "following"><img src="{{ asset($follower -> images) }}" ></button>
  </form>
  @endforeach
</div>
<div>
  <h2>ここにフォロワーの呟き一覧</h2>
  @foreach ( $followerPosts as $followerPosts )
  <form action="/followProfile" method="post">
    @csrf
    <input type="hidden" name="followId" value="{{  $follower -> id }}">
    <button id = "following"><img src="{{ asset($follower -> images) }}" ></button>
  </form>
  <h2>名前：{{ $follower->username }}</h2>
  <h2>投稿内容：{{ $followerPosts->post }}</h2>
  <p>投稿時刻：{{ $followerPosts->updated_at }}</p>
  @endforeach
</div>

@endsection
