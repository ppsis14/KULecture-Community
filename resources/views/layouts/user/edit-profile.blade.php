@extends('layouts.user.user-master')
@section('title-page', 'Edit Profile')
@section('header')
    <i class="pe-7s-user"></i>&nbsp;&nbsp;User Profile
@endsection
@section('content')
    <div class="container-fluid">
        @if (\Session::has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ \Session::get('success') }}</strong> 
                    </div>
                </div>
            </div> 
        @endif
        <div class="row">
            <div class="col-md-8">
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
                                        @if( $errors->has('username'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('username') }}
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook</label>
                                        
                                        <input type="text" class="form-control {{$errors->has('facebook')? 'is-invalid' : '' }}" name="facebook" placeholder="URL of your facebook profile" value="{{ $user->facebook }}">
                                            @if( $errors->has('facebook'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('facebook') }}
                                                </div>
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Twitter</label>
                                        
                                        <input type="text" class="form-control {{$errors->has('twitter')? 'is-invalid' : '' }}" name="twitter" placeholder="URL of your twitter profile" value="{{ $user->twitter}}">
                                            @if( $errors->has('twiiter'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('twiiter') }}
                                                </div>
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instagram</label>
                                        
                                        <input type="text" class="form-control {{$errors->has('ig')? 'is-invalid' : '' }}" name="ig" placeholder="URL of your instagram profile" value="{{ $user->instagram }}">
                                            @if( $errors->has('ig'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('ig') }}
                                                </div>
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Line ID</label>
                                        
                                        <input type="text" class="form-control {{$errors->has('line')? 'is-invalid' : '' }}" name="line" placeholder="Line ID" value="{{ $user->line }}">
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
                                        <textarea rows="5" class="form-control" name="bio" placeholder="Here can be your description">{{Auth::user()->bio}}</textarea>
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
        });
    </script>
@endsection
