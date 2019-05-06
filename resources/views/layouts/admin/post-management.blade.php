@extends('layouts.admin.admin-master')
@section('title-page', 'Post Management')
@section('header')
    <i class="pe-7s-news-paper"></i>&nbsp;&nbsp;Post Management
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Posts Table</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <table class="table table-hover table-striped table-responsive table-full-width" id="postTable">
                                <thead>
                                    <th>Post ID</th>
                                    <th>Post title</th>
                                    <th>Post By</th>
                                    <th>Create at</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                    <th>Hidden/unhidden</th>
                                </thead>
                                @if(!is_null($posts))
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->post_title }}</td>
                                        <td>{{ $post->username }}</td>
                                        <td>{{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}</td>
                                        <td>
                                            <a href="{{ action('PostsManagementController@show', ['id' => $post->id]) }}"><button type="button"  class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt fa-fw"></i></button></a>
                                        </td>
                                        <td>
                                            <a href="{{ action('PostsManagementController@destroy', ['id' => $post->id]) }}"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this post?')"><i class="fas fa-trash-alt fa-fw"></i></button></a>
                                        </td>
                                        <td>
                                            @if($post->hidden_status == false)
                                            <a href="{{ action('PostsManagementController@hidden', ['id' => $post->id]) }}"><button type="button" class="btn btn-waring btn-sm"><i class="fas fa-eye-slash fa-fw"></i></button></a>
                                            @endif
                                            @if($post->hidden_status == true)
                                            <a href="{{ action('PostsManagementController@unHidden', ['id' => $post->id]) }}"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-eye fa-fw"></i></button></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
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
        $(document).ready(function (){
            $('#postTable').DataTable();

            $('#reportedPostTable').DataTable();

            $('#post-management').addClass('active');
        });
    </script>
@endsection
