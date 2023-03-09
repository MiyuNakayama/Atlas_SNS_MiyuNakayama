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
  <h2>FollowList:アイコン一覧</h2>
  <!-- <h2></h2>これで取得出来るのはuserのid -->
  @foreach($follow as $follow)
  <form action="/followProfile" method="POST">
    @csrf
    <input type="hidden" value="{{ $follow->id }}" name="followProfile">
    <button><img src="{{ asset($follow -> images) }}"></button>
  </form>
  <!-- <p>名前：{{ $follow->username }}</p> フォアイーチの変数の定義次第表示の仕方が変わる-->
  @endforeach


  <h2>ここにフォローしている人の呟き一覧を表示したい</h2>
  @foreach($followingPosts as $followingPosts)
  <form action="/followProfile" method="POST">
    @csrf
    <input type="hidden" value="{{ $follow->id }}" name="followProfile">
  </form>
  <a href="{{URL::to('/followProfile')}}"><img src="{{ asset($follow -> images) }}" ></a>
  <p>名前：{{ $followingPosts->user->username }}</p>
  <p>投稿内容：{{ $followingPosts->post }}</p>
  <p>投稿時刻：{{ $followingPosts->updated_at }}</p>
  @endforeach

</div>

@endsection
