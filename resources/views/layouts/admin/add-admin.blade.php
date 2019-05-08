@extends('layouts.admin.admin-master')
@section('title-page', 'Add New Amin')
@section('header')
    <i class="pe-7s-add-user"></i>&nbsp;&nbsp;Add New Amin
@endsection
@section('content')
    <!-- @if ($errors->any())
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
    @endif -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Create New Admin</h4>
                    </div>
                    <div class="content">
                        <form action="{{URL::to('/admin/insert')}}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <!-- <input type="text" name="firstName" class="form-control" placeholder="Enter First Name"> -->
                                        <input type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" id="firstName" value="{{old('firstName')}}" name ="firstName" placeholder="Enter First Name">
                                        @if ($errors->has('firstName'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('firstName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <!-- <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name"> -->
                                        <input type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" id="lastName" value="{{old('lastName')}}" name ="lastName" placeholder="Enter Last Name">
                                        @if ($errors->has('lastName'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('lastName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{old('email')}}" name ="email" placeholder="Enter Email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div>
                                            <li><small>Length is equal or more than 6 digits</small></li> 
                                            <li><small>Non-alphanumeric (For example: !, $, #, or %)</small> </li>
                                        </div>
                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name ="password" placeholder="Enter new password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm your password</label>
                                        <div>
                                            <li><small>Length is equal or more than 6 digits</small></li> 
                                            <li><small>Non-alphanumeric (For example: !, $, #, or %)</small> </li>
                                        </div>
                                        <input type="password" class="form-control{{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}" id="confirmPassword" name ="confirmPassword" placeholder="Enter password to confirm">
                                        @if ($errors->has('confirmPassword'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('confirmPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Create New Admin</button>
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
            $('#add-admin').addClass('active');
            if({{ \Session::has('success') }}){
                var session_success = '{{ \Session::get('success') }}';
                showNotification('top', 'center', 'pe-7s-check', '<b> Success </b>- '+session_success, 'success');
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
