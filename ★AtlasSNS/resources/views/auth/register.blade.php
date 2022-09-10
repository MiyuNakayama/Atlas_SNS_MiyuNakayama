@extends('layouts.logout')

@section('content')

<!--↓バリデーションで引っ掛かるとエラーメッセージが表示される-->
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

{!! Form::open(['url' => '/register']) !!}
<!--↑新規登録/登録後のページ遷移先の変更。新規ユーザー登録するページへの移行。urlを追記。-->

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'password_confirmation']) }}
<!--↑クラス名をpasswordから修正。修正前だと延々にバリデーションが効かずログインをぐるぐるする-->

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
