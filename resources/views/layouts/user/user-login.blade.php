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
            <div id="my-signin2" data-onsuccess="onSignIn"> Sign In</div>
        </div>
        <br><br>
        <div class="text-center w-full">
            <a class="txt1" href="#">
                Create new account
            </a>
        </div>
    </article>

@endsection

@section('script')
    <script>
        function onSuccess(googleUser) {
          console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
          onSignIn(googleUser);

        }
        function onFailure(error) {
          console.log(error);
        }
        function renderButton() {
          gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
          });
        }
    </script>

    <script>
        function signOut() {
          var auth2 = gapi.auth2.getAuthInstance();
          auth2.signOut().then(function () {
            console.log('User signed out.');
          });
        }

        function onLoad() {
            gapi.load('auth2', function() {
              gapi.auth2.init();
            });
        }
    </script>

    <script>
        function onSignIn(googleUser) {
            var profile=googleUser.getBasicProfile();

            // get id token from google
            var id_token = googleUser.getAuthResponse().id_token;

            // send google token to login page
            callPHP(id_token);
            function callPHP(params) {
                var httpc = new XMLHttpRequest(); // simplified for clarity
                var url = "view/login/login.php";
                httpc.open("POST", url, true); // sending as POST
                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                httpc.onload = function() {
                document.location.href = "http://localhost/CAAS_project/home.php";
                };
                httpc.send('idtoken='+id_token);

            }
        }
        function changePage(){
            var url ;
            l;
        }
        function clearUsernamePassword(){

        }
    </script>

    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
@endsection
