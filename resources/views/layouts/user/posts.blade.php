@extends('layouts.user.user-master')
@section('title-page', 'User Posts')
@section('header')
    <i class="pe-7s-news-paper"></i>&nbsp;&nbsp;Posts
@endsection
@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    <style>
    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        display: inline-block;
        padding: 4px 6px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 22px;
        cursor: text;
        height: 40px;
    }
    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: text-bottom;
        border-radius: .25em;
    }
    </style>


    <div class="container-fluid">
    <br>
        <div class="row" id="normal-search" style="text-align: center;">
            <ul class="nav navbar-nav">
                <li >
                    <a >
                        <p>Category: </p>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <p>
                            {{$dropdown}}
                            <b class="caret"></b>
                        </p>
                    </a>
                        <ul class="dropdown-menu">
                            @foreach($categorys as $category)
                                <li><a href="/user/posts/category/{{ $category}}">{{ $category}}</a></li>
                            @endforeach
                        <li class="divider"></li>
                        <li><a href="{{ action('PostsController@index')}}">All</a></li>
                        </ul>
                </li>
            </ul>
            <form action="{{ action('PostsController@search', ['dropdown' => $dropdown]) }}" role="search" method="get">
                <div class="col-md-8">
                    <div class="form-group"> 
                        <input class="form-control" type="text" name="key" placeholder="Search..." aria-label="Search" value="{{ old('title')}}">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn" name="button" id="btn-search"><i class="fas fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row" id="normal-search">
            <div class="form-group" style="text-align: center;">
                <button style="border: transparent;" type="button" class="btn" name="button" id="btn-advance"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Advance Search</button>
            </div>
        </div>

        <div class="row" id="normal-search">
                <div class="form-group" style="text-align: center;">
                    <button style="border: transparent;" type="button" class="btn" id="btn-normal"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Back To Normal Search</button>
                </div>
        </div>

        <div class="row" id="advance-search">
            <div class="col-sm-12">
                <div class="card" style="padding: 20px;">
                    <h4 class="card-title">Advance Search</h4>
                    <div class="card-body">
                        <form action="{{ action('PostsController@advance', Auth::user()->id) }}" role="search" method="get">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Post Title</label>
                                            <input type="text" class="form-control" name="post_title">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="category">Category</label><br>
                                            <select class="form-control" id="category" name="category" value="{{ old('category')}}">
                                                @foreach($categorys as $category)
                                                    <option value="{{ $category}}" >{{ $category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                                <label>Tag</label><br/>
                                                <input style="height: 40px;" data-role="tagsinput" type="text" name="tags" id="input-tags" class="typeahead form-control" value="{{ old('tags')}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Search</button>
                                <div class="clearfix"></div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div >
            @if(isset($query))
            <hr>
            <h4>The search result for <b>{{ $query }}</b> are :</h4>
            @endif
        </div>

        @if(isset($details))
            @if(count($details) == 0)
                <div class="row">
                    <h4 style="text-align: center;">No posts</h4>
                </div>
            @endif
        @endif

        <div class="row">
            @if(isset($details))
            @foreach($details as $post)
                <div class="col-sm-6">
                @if($post->report_status == true)
                    <div class="card" style="padding: 20px; background-color: #ffe5e1;">
                @endif
                @if($post->hidden_status == true && $post->report_status == false)
                    <div class="card" style="padding: 20px; background-color: #e8f6fe;">
                @endif
                @if($post->report_status == false && $post->hidden_status == false)
                    <div class="card" style="padding: 20px;">
                @endif
                @if($post->post_cover == null)
                    <img src="http://lorempixel.com/400/200" class="card-img-top" alt="Card image cap" width="100%"/>
                @endif
                @if($post->post_cover != null)
                    <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" class="card-img-top" alt="Card image cap" width="100%"/>
                @endif
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ action('PostsController@show', ['id' => $post->id]) }}">{{$post->post_title}}</a></h4>
                        <p class="card-text">{{$post->description}}</p>
                        <br>
                        <p class="card-text"><small class="text-muted">Category: <a href="/user/explorer/category/{{$post->category}}">{{$post->category}}</a>&nbsp;&nbsp; Tag : 
                            @foreach($post->tags as $tag)
                                <a href="/user/explorer/tag/{{$tag->slug}}">{{$tag->slug}}</a>
                            @endforeach
                        </small></p>
                        <p class="card-text"><small class="text-muted">Created: {{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}
                        &nbsp;Last updated: {{$post->updated_at->format('j F Y')}} at {{$post->updated_at->format('H:m')}}</small>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                        <hr>
                        <p> 
                            <ul class="post-action-container">
                                <li>
                                    <button style="border: transparent;" class="btn">
                                        <a href="{{ action('PostsController@edit', ['id' => $post->id]) }}" title="Click to edit this post">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                    </button>
                                </li>
                                <li>
                                    <form action="{{ action('PostsController@destroy', ['id' => $post->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Click to delete this post" type="submit" class="btn delete-post" style="border: transparent; color: tomato;"><i class="fas fa-trash-alt fa-fw"></i></button>
                                    </form>
                                </li>
                                <li>
                                        <!-- unhide post -->
                                        @if($post->hidden_status == false) 
                                        <button  style="border: transparent;" class="btn" >
                                            <a href="{{ action('PostsController@hidden', ['id' => $post->id]) }}" title="Click to hide this post">
                                                <i class="fas fa-eye-slash "></i>
                                            </a>
                                        </button>
                                        @endif
                                        <!-- hide post -->
                                        @if($post->hidden_status == true)
                                        <button  style="border: transparent;" class="btn" >
                                            <a href="{{ action('PostsController@unHidden', ['id' => $post->id]) }}" title="Click to unhide this post" >
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </button>
                                        @endif
                                </li>
                            </ul>
                            
                        </p>
                    </div>
                </div>
                </div>   
            @endforeach
            @endif
            <div class="row">
                @if(isset($message))
                    <h4 style="text-align: center;">{{ $message }}</h4>
			    @endif
            </div>

            <div class="row" style="text-align: center;">
                {{$details->links()}}
            </div>

        </div>
    </div>
    <a href="{{ action('PostsController@create') }}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Create new post</div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#posts').addClass('active');

            $('#advance-search').hide();
            $('#btn-normal').hide();

            $('#btn-advance').click(function () {
                $('#advance-search').show();
                $('#normal-search').hide();
                $('#btn-advance').hide();
                $('#btn-normal').show();
            });

            $('#btn-normal').click(function () {
                $('#advance-search').hide();
                $('#normal-search').show();
                $('#btn-normal').hide();
                $('#btn-advance').show();
            });

            $('.delete-post').click(function(e) {
                e.preventDefault();
                var is_confirm = confirm('Are you sure to delete this post ?');

                if(is_confirm) {
                    $(e.target).closest('form').submit();
                }
            });
        });
    </script>

    <script type="text/javascript">
	    $('#input-tags').tagsInput();
    </script>

<script type="text/javascript">
        $(document).ready(function (){
            
            if({{ \Session::has('success') }}){
                var session_success = '{{ \Session::get('success') }}';
                showNotification('top', 'center', 'pe-7s-check', session_success, 'danger');
            }else{
                var session_error = '<b> Error </b>';
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
