@extends('layouts.user.user-master')
@section('title-page', 'Edit Profile')
@section('header')
    <i class="pe-7s-user"></i>&nbsp;&nbsp;User Profile
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ action('UserProfileController@update' , ['id' => Auth::user()->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control {{$errors->has('username')? 'is-invalid' : '' }}" name="username" placeholder="Username" value="{{ old('username', Auth::user()->username) }}">
                                        <!-- @if( $errors->has('username'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('username') }}
                                            </div>
                                        @endif -->
                                        @if ($errors->has('username'))
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $errors->first('username')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook Username</label>
                                        <input type="text" class="form-control {{$errors->has('facebook_username')? 'is-invalid' : '' }}" name="facebook_username" placeholder="Facebook username" value="{{ old('facebook_username', $profile->facebook_username) }}">
                                            @if( $errors->has('facebook_username'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('facebook_username') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook url link</label>
                                        <input type="text" class="form-control {{$errors->has('facebook')? 'is-invalid' : '' }}" name="facebook" placeholder="URL of your facebook profile" value="{{ old('facebook', $profile->facebook) }}">
                                            @if( $errors->has('facebook'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('facebook') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Twitter Username</label>
                                        <input type="text" class="form-control {{$errors->has('twitter_username')? 'is-invalid' : '' }}" name="twitter_username" placeholder="Twitter username" value="{{ old('twitter_username', $profile->twitter_username) }}">
                                            @if( $errors->has('twitter_username'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('twitter_username') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Twitter url link</label>
                                        <input type="text" class="form-control {{$errors->has('twitter')? 'is-invalid' : '' }}" name="twitter" placeholder="URL of your twitter profile" value="{{ old('twitter', $profile->twitter) }}">
                                            @if( $errors->has('twitter'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('twitter') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instagram Username</label>
                                        <input type="text" class="form-control {{$errors->has('ig_username')? 'is-invalid' : '' }}" name="ig_username" placeholder="Instagram username" value="{{ old('instagram_username', $profile->instagram_username) }}">
                                            @if( $errors->has('ig_username'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('ig_username') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instagram url link</label>
                                        <input type="text" class="form-control {{$errors->has('ig')? 'is-invalid' : '' }}" name="ig" placeholder="URL of your instagram profile" value="{{ old('instagram', $profile->instagram) }}">
                                            @if( $errors->has('ig'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('ig') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Line ID</label>
                                        <input type="text" class="form-control {{$errors->has('line')? 'is-invalid' : '' }}" name="line" placeholder="Line ID" value="{{ old('line', $profile->line) }}">
                                            @if( $errors->has('line'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('line') }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea rows="5" class="form-control" name="bio" placeholder="Text something to describe ypur persoanlity">{{ $profile->bio}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#profile').addClass('active');

            
            if({{ \Session::has('success') }}){
                var session_success = '{{ \Session::get('success') }}';
                showNotification('top', 'center', 'pe-7s-check', '<b> Success </b>- '+session_success, 'success');
            }else{
                var session_error = '<b> Error </b> - Your information updating is error, please fill up in filed correctly';
                showNotification('top', 'center', 'pe-7s-close-circle', session_error, 'danger');
            }
        });

        function showNotification(from, align, icon, message, color){
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
