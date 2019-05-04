@extends('layouts.admin.admin-master')
@section('title-page', 'Change Password')
@section('header')
    <i class="pe-7s-key"></i>&nbsp;&nbsp;Change Password
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Change Password</h4>
                    </div>
                    <div class="content">
                        <form>
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
                                        <input type="password" name="newPassword" class="form-control" placeholder="Enter new password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm your new password</label>
                                        <input type="password" name="confirmPassword" class="form-control" placeholder="Enter new password to confirm">
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
