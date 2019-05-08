@extends('layouts.admin.admin-master')
@section('title-page','User Management')
@section('header')
    <i class="pe-7s-user"></i>&nbsp;&nbsp;User Management
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Admins Table</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <table class="table table-hover table-striped table-responsive table-full-width" width="100%" id="adminTable">
                                <thead>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email Account</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach( $admins as $admin)
                                    <tr>
                                        <td>{{$admin->id}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>
                                        @if(Auth::user() and Auth::user()->can('delete', $admin))
                                        <form action="{{action('UsersManagementController@destroy', ['id' => $admin->id])}}" method="post">
                                            @csrf
                                            @method('Delete')
                                            <button onclick="return confirm('Do you want to delete this account?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button>
                                        </form>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Users Table</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <table class="table table-hover table-striped table-responsive table-full-width" width="100%" id="userTable">
                                <thead>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email Account</th>
                                    <th>Total Post</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                
                                @foreach( $users as $user)
                                    @php
                                        $total_post = \App\Post::where('user_id', $user->id)->count();
                                    @endphp
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ $total_post }}</td>
                                        <td>
                                        <form action="{{action('UsersManagementController@destroy', ['id' => $user->id])}}" method="post">
                                            @csrf
                                            @method('Delete')
                                            <button onclick="return confirm('Do you want to delete this account?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#userTable').DataTable({
                responsive: true,
                scrollX : true,
                scrollCollapse : true
            });
            $('#adminTable').DataTable({
                responsive: true,
                scrollX : true,
                scrollCollapse : true
            });

            $('#user-management').addClass('active');
        } );
    </script>
@endsection
