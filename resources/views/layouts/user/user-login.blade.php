@extends('layouts.login-master')
@section('style-css')
    <link rel="stylesheet" href="{{('/css/user-loginStyle.css')}}">
@endsection
@section('content')
    <section id="banner">
        <div class="login-title">
            <div class="name-box">
                <div class="name">KU NSC</div>
                <h5 class="full-name">KU Knowledge Share Community</h5>
            </div>
        </div>
    </section>
    <article>
        <div class="detail-box">
            <p>Let's share and share your knowledge and experiences with our community.</p>
        </div>
        <div class = "row d-flex justify-content-md-center login-btn">
            <div type="button" class="btn btn-primary" onclick=window.location="{{ url('login/google') }}">Sign In With Google</div>
        </div>
        <br><br>
        <div class="text-center w-full">
            <a class="txt1" href="#">
                Create new account
            </a>
        </div>
    </article>

@endsection

