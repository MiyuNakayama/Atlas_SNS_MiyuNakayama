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
  <h2>フォロワーのアイコン一覧と、呟きの一覧が出て欲しい</h2>
  @foreach ($follower  as $follower )
  <img src="{{ asset($follower->images) }}">
  @endforeach

  <h2>ここにフォロワーの呟き一覧（一旦usernameと呟き表示したい）</h2>
  @foreach ($followerPosts as $followerPosts)
  <img src="{{ asset($follower->images) }}">
  <h2>名前：{{ $follower->username }}</h2>
  <h2>投稿内容：{{ $followerPosts->post }}</h2>
  <p>投稿時刻：{{ $followerPosts->updated_at }}</p>
  @endforeach
</div>

@endsection
