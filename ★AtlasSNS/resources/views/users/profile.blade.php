@extends('layouts.login')

@section('content')
<div class = "profile">

  <form action="/profileUpdate" method ="POST">
    <h2>user name</h2>
    <input type ="text" name="edit_userName" value ="{{ Auth::user()->username }}" >

    <h2>mail adress</h2>
    <input type ="text" name="edit_mailAdress" value ="{{ Auth::user()->mail }}">

    <h2>password</h2>
    <input type ="password" name="password" placeholder ="パスワードを入れてね！">

    <h2>password confirm</h2>
    <input type ="passwordConfirmation" name="edit_passwordConfirmation" placeholder ="パスワードをもう一回入れてね！">

    <h2>bio</h2>
    <input type ="text" name="edit_bio" value ="{{ Auth::user()->bio }}">

    <h2>icon image</h2>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <input type="file" name="image"><!--acceptで受け入れるデータの形式を決めることもできる-->
        <button type="submit">プロフィールを更新する</button>

      </form>
    </form>
</div>
@endsection
