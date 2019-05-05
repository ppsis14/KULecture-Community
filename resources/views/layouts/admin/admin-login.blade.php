@extends('layouts.login-master')
@section('style-css')
    <link rel="stylesheet" href="{{('/css/admin-loginStyle.css')}}">
@endsection
@section('title', 'Sign in for Admin')
@section('content')
    <div class="row col-lg-12 offset=md-1 justify-content-center">
        <div class="row">
            <div class="col-md-6 login-left justify-content-center">
            <br><br><br>
                <div class="row justify-content-center">
                    <img src="/img/kunsc-logo.png" alt="" class="logo-admin">
                </div>
                <br><br>
                <div class="row justify-content-center">
                    <h4>KU Knowledge Share Community</h4>
                </div>
                <br><br>
            </div>
            <div class="col-md-6 login-right d-flex justify-content-center">
                <div class="login-form">
                    <div class ="row d-flex justify-content-center">
                        <h1>Sign in</h1>
                    </div><hr><br><br>
                    <div class ="row d-flex justify-content-center">
                        <form class="login" id ="admin-login" action="{{ route('login') }}" method="POST">
                        @csrf
                            <div class="form-group" >
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" name ="username" aria-describedby="emailHelp" placeholder="Enter Username" >
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><br>
                            <div class="form-group" >
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name = "password" placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
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
            </div>
        </div>
    </div>
    <!-- <div class="form-title">
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
            <form class="login" id ="admin-login" action="{{ route('login') }}" method="POST">
            @csrf
                <div class="form-group" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" name ="username" aria-describedby="emailHelp" placeholder="Enter Username" >
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br>
                <div class="form-group" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name = "password" placeholder="Enter Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
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
    </div> -->
@endsection
