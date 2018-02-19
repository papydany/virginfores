@extends('layouts.login')
@section('title','Login')
@section('content')

<div class="login-wrapper ">

<div class="bg-pic">

<img src="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">



</div>


<div class="login-container bg-white">
<div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">

<p class="p-t-35">Sign into your  account</p>


    @if(Session::has('status'))
    <div class="row">
    <div class=" col-sm-10 col-sm-offset-1 alert alert-warning" role="alert" >
      {{Session::get('status')}}
    </div>
</div>
    @endif
 

<form id="form-login" class="p-t-15" role="form" method="POST" action="{{ route('login') }}">
{{ csrf_field() }}
<div class="form-group form-group-default">
<label>Login</label>
<div class="controls">
<input type="text" name="email" placeholder="Email" class="form-control" required>
</div>
</div>


<div class="form-group form-group-default">
<label>Password</label>
<div class="controls">
<input type="password" class="form-control" name="password"  required>
</div>
 </div>

<div class="row">
<button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
<div class="col-md-6 d-flex align-items-center justify-content-end">
 <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
</div>
</div>


</form>


</div>
</div>

</div>

@endsection
