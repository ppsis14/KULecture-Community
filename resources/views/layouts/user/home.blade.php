@extends('layouts.user.user-master')
@section('title-page', 'User Home')
@section('header')
    <i class="pe-7s-home"></i>&nbsp;&nbsp;Home
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="image">
                        <img src="/img/mats-peter-forss-12122-unsplash.jpg" alt="" style="object-fill: certain;">
                    </div>
                    <br>
                    <div class="content">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ $profile->avatar }}" alt="..."/>
                                <br>
                                <a href="{{ action('HomeUserController@show', ['id' => Auth::user()->id]) }}">
                                    <h4 class="title">{{ Auth::user()->username }}<br><br>
                                    <small>{{ Auth::user()->name }}</small><br><br>
                                    <small><i class="fas fa-envelope fa-fw"></i>&nbsp;&nbsp;{{ Auth::user()->email }}</small>
                                    </h4>
                                </a>
                        </div><br><br>
                        @if(!is_null($profile->bio))
                        <div class="card-body">
                            <hr><br>
                            <div class="container-bio">
                                <p class="description"> {{ $profile->bio }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <hr>
                    <!-- flex box -->
                    <ul class="social-container">
                        @if(!is_null($profile->facebook))
                        <li>
                            <img src="/img/icon-img/icons8-facebook.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="{{ $profile->facebook }}" target="_blank">{{ $profile->facebook_username }}</a></span>
                        </li>
                        @endif
                        @if(!is_null($profile->instagram))
                        <li>
                            <img src="/img/icon-img/icons8-instagram.svg" class="img-icon"">&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="{{ $profile->instagram }}" target="_blank">{{ $profile->instagram_username }}</a></span>
                        </li>
                        @endif
                        @if(!is_null($profile->twitter))
                        <li>
                            <img src="/img/icon-img/icons8-twitter.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="{{ $profile->twitter }}" target="_blank">{{ $profile->twitter_username }}</a></span>
                        </li>
                        @endif
                        @if(!is_null($profile->line))
                        <li>
                            <img src="/img/icon-img/icons8-line.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $profile->line }}</span>
                        </li>
                        @endif
                    </ul>
                    <br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">

                    <div class="card text-black" style="padding: 30px;" align="center" >
                        <div class="card-header"><h2 class="card-title">Posts</h2></div>
                        <div class="card-body">
                            <p class="card-text"><h3>{{$all_post}}</h3></p>
                        </div>
                    </div>
                
                
            </div>
            <div class="col-sm-4">
                
                    <div class="card text-black" style="padding: 30px;" align="center" >
                        <div class="card-header"><h2 class="card-title">Hidden Posts</h2></div>
                        <div class="card-body">
                            <p class="card-text"><h3>{{$hidden_post}}</h3></p>
                        </div>
                    </div>     
                
            </div>
            <div class="col-sm-5">
                
                    <div class="card text-black" style="padding: 30px;" align="center" >
                        <div class="card-header"><h2 class="card-title">Reported Posts</h2></div>
                        <div class="card-body">
                            <p class="card-text"><h3>{{$report_post}}</h3></p>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            if({{ \Session::has('newUser') }}){
                var session_user = '{{ Session::get('newUser') }}';
                showNotification('top', 'right', 'pe-7s-bell', session_user, 'info');
            }
            

            
        });
        function showNotification(from, align, icon, message, color){
                // color = Math.floor((Math.random() * 4) + 1);

                $.notify({
                    icon: icon,
                    message: message

                },{
                    type: color,
                    timer: 4000,
                    placement: {
                        from: from,
                        align: align
                    }
                });
            }
        
    </script>
@endsection
