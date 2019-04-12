@extends('layouts.login-master')
@section('style-css')
    <link rel="stylesheet" href="{{('/css/admin-loginStyle.css')}}">
@endsection
@section('content')
    <div class="form-title">
        <div class="name-box">
            <div class="name">KU NSC</div>
            <h6 class="full-name">KU Knowledge Share Community</h6>
        </div>
    </div>
    <div class="login-form">
        <div class ="row d-flex justify-content-center">
            <h1>Sign in</h1>
        </div><hr><br><br>
        <div class ="row d-flex justify-content-center">
            <form class="login" id ="admin-login" method="POST"  enctype="multipart/form-data">
                <div class="form-group" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" id="username" name ="username" aria-describedby="emailHelp" placeholder="Enter Username">
                    </div>
                </div><br>
                <div class="form-group" >
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                      </div>
                      <input type="password" class="form-control" id="password" name = "password" placeholder="Enter Password">
                  </div>
                </div><br><br>
                <div>
                    <button type="submit" class="btn btn-primary btn-block login-btn">Sign in</button>
                </div>
            </form>
            <div class="d-flex justifycontext-center" >
                    <p class="" id="password" style="color:red" name = "errorAdmin" id = "error Admin"></p>
            </div>
        </div>
    </div>
@endsection
