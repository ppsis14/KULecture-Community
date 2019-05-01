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
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <a href="{{ url('login/google') }}" class="btn btn-primary">{{ __('Sign in with Google') }}</a>
            </div>
        </div>
 
    </article>

@endsection

