@extends('layouts.admin.admin-master')
@section('title-page', 'Change Password')
@section('header')
    <i class="pe-7s-key"></i>&nbsp;&nbsp;Change Password
@endsection
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Change Password</h4>
                    </div>
                    <div class="content">
                        <form action="{{URL::to('/admin/changepw')}}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" name="currentPassword" class="form-control" placeholder="Your current password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <div>
                                            <li><label>Length is equal or more than 6 digits</label></li> 
                                            <li><label>Non-alphanumeric (For example: !, $, #, or %)</label> </li>
                                        </div>
                                        <!-- <input type="password" name="newPassword" class="form-control" placeholder="Enter new password"> -->
                                        <input type="password" class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}" name ="newPassword" placeholder="Enter new password">
                                        @if ($errors->has('newPassword'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('newPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm your new password</label>
                                        <!-- <input type="password" name="confirmPassword" class="form-control" placeholder="Enter new password to confirm"> -->
                                        <input type="password" class="form-control{{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}" name ="confirmPassword" placeholder="Enter new password to confirm">
                                        @if ($errors->has('confirmPassword'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('confirmPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Password</button>
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
            $('#change-password').addClass('active');
        });
    </script>
@endsection
