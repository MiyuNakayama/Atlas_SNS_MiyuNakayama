@extends('layouts.login')

@section('content')
<div class = "profile">

  <h2>user name</h2>
  <form action="/profileUpdate" method = POST>
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
    <!-- <input type ="image" name="edit_icon" placeholder =""> -->

    <form method="POST" action="upimg.php" enctype="multipart/form-data">
        <input type="file" name="upimg" accept="image/*">
    </form>

    <input type ="submit" name="bottom">
</form>
</div>
@endsection
