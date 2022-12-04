
@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Example</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link rel="stylesheet" href="style.css">


</head>
<body>
  
    <div class="container">
    @if (Session::get('SuccessLogout'))
			<!-- <div class="alert alert-success">
				{{ Session::get('Yeay') }}
			</div> -->
            <script>Swal.fire(
  'Good Job!',
  'Anda sudah berhasil logout!',
  'success'
)</script>
    @endif
    @if (Session::get('fail'))
			<div class="alert alert-danger">
				{{ Session::get('fail') }}
			</div>
		@endif
    @if (Session::get('notAllowed'))
			<div class="alert alert-danger">
				{{ Session::get('notAllowed') }}
			</div>
		@endif
    @if (Session::get('SuccessRegister'))
			<!-- <div class="alert alert-danger">
				{{ Session::get('SuccessRegister') }}
			</div> -->
      <script>Swal.fire(
  'Good Job!',
  'Anda sudah berhasil register!',
  'success'
)</script>
		@endif
    @if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<br>
<form method="POST" action="{{route('login.auth')}}">
  @csrf
<br>
<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <div class="sign-in-htm">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="user" type="text" class="input" name="username">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="pass" type="password" class="input" data-type="password" name="password">
        </div>
        <div class="group">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Keep me Signed in</label>
        </div>
        <div class="group">
          <input type="submit" class="button" name="login" value="Sign In">
        </div>
      </div>
</form>
<form method="POST" action="{{route('register.post')}}">
  @csrf
      <div class="sign-up-htm">
        <div class="group">
          <label for="user" class="label">Name</label>
          <input id="user" type="text" class="input" name="name" value="{{ old('name') }}">
        </div>
        <div class="group">
          <label for="pass" class="label">Username</label>
          <input id="pass" type="text" class="input" name="username" value="{{ old('username') }}">
        </div>
        <div class="group">
          <label for="pass" class="label">Email</label>
          <input id="pass" type="text" class="input" name="email" value="{{ old('username') }}">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="pass" type="password" class="input" data-type="password" name="password">
        </div>
        <div class="group">
          <input type="submit" class="button" name="register" value="Sign Up">
        </div>
      </div>
    </div>
  </div>
</div>
</form>
    <!-- /resources/views/post/create.blade.php -->
 
 
 @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
  
 <!-- Create Post Form -->

    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
    @endsection
    
