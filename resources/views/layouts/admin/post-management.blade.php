@extends('layouts.admin.admin-master')
@section('title-page', 'Post Management')
@section('header')
    <i class="pe-7s-news-paper"></i>&nbsp;&nbsp;Post Management
@endsection
@section('content')
    <div class="container-fluid">
        <!-- @if( Session::has('success'))
            <script>
                var session_msg = Session::get('success');
                showNotification('top', 'center', 'pe-7s-check', '<b> Success </b>- '+session_msg, 'success');
            </script>
        @endif -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Posts Table</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <table class="table table-hover table-striped table-responsive table-full-width" width="100%" id="postTable">
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
                                            <form action="{{ action('PostsManagementController@destroy', ['id' => $post->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                                <a href=""><button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this post?')"><i class="fas fa-trash-alt fa-fw"></i></button></a>
                                            </form>
                                        </td>
                                        <td>
                                            @if($post->hidden_status == false)
                                            <a href="{{ action('PostsManagementController@hidden', ['id' => $post->id]) }}"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-eye-slash fa-fw"></i></button></a>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                        <div class="form-group" style="text-align: center;">
                            <button style="border: transparent;" type="button" class="btn" name="button" id="btn-cate-advance"><a href="{{ action('AdminExplorePostsController@index')}}" >Posts Explorer</a> </button>
                            <button style="border: transparent;" class="btn" id="line-advance"> | </button>
                            <button style="border: transparent;" type="button" class="btn" name="button" id="btn-tag-advance"><a href="{{ action('AdminExplorePostsController@all_tag') }}">See All tags</a> </button>         
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Category Management</h4>
                        <hr>
                        <form action="{{ action('PostsManagementController@addCategory')}}" method="post">
                            @csrf
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" name="category_name" placeholder="Category Name">
                                    @if( $errors->has('category_name'))
                                        <span class="invalid-feedback" style="color: red">
                                            {{ $errors->first('category_name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-fill pull-right btn-block">Add Category</button>
                                </div>
                            </div>
                        </form> 
                        <br><br><br>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <table class="table table-hover table-striped table-responsive table-full-width" width="100%" id="categoryTable">
                                <thead>
                                    <th>No.</th>
                                    <th>Category Name</th>
                                </thead>
                                @if(!is_null($categories))
                                @php
                                    $count = 0
                                @endphp
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $count += 1 }}</td>
                                        <td>{{ $category->name }}</td>
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
            $('.delete-post').click(function(e) {
                e.preventDefault();
                var is_confirm = confirm('Are you sure to delete this post ?');

                if(is_confirm) {
                    $(e.target).closest('form').submit();
                }
            });
            $('#postTable').DataTable({
                responsive: true,
                scrollX : true,
                scrollCollapse : true
            });

            $('#categoryTable').DataTable({
                responsive: true,
                scrollX : true,
                // scrollY : true,
                scrollCollapse : true
            });

            $('#post-management').addClass('active');
            
        });
    </script>
    <script>
        $(document).ready(function () {
            if({{ Session::has('success') }}){
                var session_msg = '{{ Session::get('success') }}';
                showNotification('top', 'center', 'pe-7s-check', '<b> Success </b>- '+session_msg, 'success');
            }
            // else if({{ Session::has('failure') }}){
            //     var session_msg = '{{ Session::get('failure') }}';
            //     showNotification('top', 'center', 'pe-7s-close-circle', '<b> Failure </b>- '+session_msg, 'danger');
            // }
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
