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
  @foreach($follow as $follow)
  <form action="followProfile" method="post">
    <input type="hidden" name="followId" value="{{  $follow -> id }}">
  <a class="followProfile" href="followProfile">
    <img src="{{ asset($follow -> images) }}" >
    </a>
  </form>
  @endforeach


  <h2>ここにフォローしている人の呟き一覧を表示したい</h2>
  @foreach($followingPosts as $followingPosts)
  <!-- <form action="/{ $follow -> id }/followProfile" method="POST">
    <input type="hidden" name="id" value="{{ $follow->id }}">
     @csrf
  </form> -->
  <a class="followProfile" href="followProfile">
    <input type="hidden" name="followId" value="{{ $follow -> id }}">
    <img src="{{ asset($follow -> images) }}" >
  </a>

  <p>名前：{{ $followingPosts->user->username }}</p>
  <p>投稿内容：{{ $followingPosts->post }}</p>
  <p>投稿時刻：{{ $followingPosts->updated_at }}</p>
  @endforeach

</div>

@endsection
