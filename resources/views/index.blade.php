@extends('layouts.login-master')
@section('style-css')
    <link rel="stylesheet" href="{{('/css/user-loginStyle.css')}}">
@endsection
@section('title', 'KU NSC Sign in')
@section('content')
    <article>
        <div class="row justify-content-center">
            <img src="/img/kunsc-logo.png" alt="" class="logo-user">
        </div>
        <br><br>
        <div class="row justify-content-center">
            <h4>KU Knowledge Share Community</h4>
        </div>
        <hr>
        <div class="detail-box justify-content-center">
            <p>Let's share what we have, what we know for others. In addition to sharing, you will still get something new that has never been known. Have fun with it.</p>
        </div>
        <div class="row justify-content-center">
            <a href="{{ route('login') }}" class="google-button">
                <button type="button" class="google-button">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-users-cog fa-fw"></i>
                    <span class="google-button__text">Sign in as Admin</span>
                </button>
            </a>   
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ url('user/login') }}" class="google-button">
                <button type="button" class="google-button">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-user-friends fa-fw"></i>
                    <span class="google-button__text">Sign in as User</span>
                </button>
            </a>   
        </div>
    </article>

@endsection

