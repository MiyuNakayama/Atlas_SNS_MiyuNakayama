@extends('layouts.login')
@section('content')
<!-- <div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div> -->

<div class=followProfile>
    <div class=followProfileMain>
        <p>フォロー、フォロワーのプロフィールの表示</p>
        icon{{ $followProfile->images }}
        username{{ $followProfile->username }}
        bio{{ $followProfile->bio }}

        <!--プロフィール表示のフォローボタン-->
        <!--if(条件①ログインユーザーのidが、following_idと一致 && followed_idが、$followProfile->idと一致)else(条件①以外の場合)-->
        @if(Auth::user()->isFollowing($followProfile->id))
        <!--User.phpのisFollowing()メゾットでfollowed_idが取得出来るため利用する-->

        <form action="/unFollow" method ="post"><!--ここのメゾットはgetにする-->
            <input type ="submit" name ="profileUnFollow" value ="フォロー解除する">
            <!--name属性いらない-->
            <input type="hidden" name="id" value= "{{$followProfile->id}}" class="followsButton">
            <!--aタグでid載せて-->
            {{ csrf_field() }}
        </form>
        @else
        <form action="/follow" method ="post"><!--ここのメゾットはgetにする-->
            <input type ="submit" name ="profileFollow" value ="フォローする">
            <input type="hidden" name="id" value= "{{$followProfile->id}}" class="followsButton">
            {{ csrf_field() }}
        </form>
        @endif
    </div>

    <div class=followProfilePosts>
        <p>プロフィールの投稿一覧</p>
        @if(empty($followPost))
        <p>投稿はありません</p>
        @else
        @foreach($followPost as $followPost)
        <div>post{{ $followPost->post }}</div>
        @endforeach
        @endif
    </div>
</div>

@endsection
