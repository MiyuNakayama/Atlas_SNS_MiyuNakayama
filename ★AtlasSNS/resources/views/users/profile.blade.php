@extends('layouts.login')

@section('content')
<div class = "profile">
  <h2>user name</h2><form action="/profile">
    <input type ="text" name="edit_userName">
    {{}}
  </form>
  <h2>mail adress</h2><form action="/profile">
    <input type ="email" name="edit_mailAdress" placeholder ="">
  </form>
  <h2>password</h2><form action="/profile">
    <input type ="password" name="" placeholder ="edit_password">
  </form>
  <h2>password comfirm</h2><form action="/profile">
    <input type ="passwordConfirmation" name="edit_passwordComfirmation" placeholder ="">
  </form>
  <h2>bio</h2><form action="/profile">
    <input type ="text" name="edit_bio" placeholder ="">
  </form>
  <h2>icon image</h2><form action="/profile">
    <input type ="image" name="edit_icon" placeholder ="">
  </form>

  <form action="/profile">
    <input type ="submit" name="更新" placeholder ="">
  </form>
</div>
@endsection
