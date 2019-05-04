@extends('layouts.admin.admin-master')
@section('title-page', 'Add New Amin')
@section('header')
    <i class="pe-7s-add-user"></i>&nbsp;&nbsp;Add New Amin
@endsection
@section('content')
    <!-- @if(session()->has('jsAlerrt'))
    <script>
        var msg ='{{Session::get('jsAlert')}}';
        var exist = '{{Session::has('jsAlert')}}';
        if(exist){
            alert(msg);
        }
        // alert({{session()->get('jsAlert')}});
    </script>
    @endif -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
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
                                        <input type="text" name="firstName" class="form-control" placeholder="Enter First Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter new password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirm your password</label>
                                        <input type="password" name="confirmPassword" class="form-control" placeholder="Enter password to confirm">
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
        });
    </script>
@endsection
