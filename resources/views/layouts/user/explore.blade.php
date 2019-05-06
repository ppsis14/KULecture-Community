@extends('layouts.user.user-master')
@section('title-page', 'Posts Explorer')
@section('header')
    <i class="pe-7s-global"></i>&nbsp;&nbsp;Posts Explorer
@endsection
@section('content')
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
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
                            &nbsp;&nbsp;&nbsp;{{$dropdown}}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($categorys as $category)
                            <li><a href="/user/explorer/category/{{ $category}}">{{ $category}}</a></li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a href="{{ action('ExplorePostsController@index')}}">All</a></li>
                    </ul>
                </li>
            </ul>
            <form action="{{ action('ExplorePostsController@search', ['dropdown' => $dropdown]) }}" role="search" method="get">
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
                    <button style="border: transparent;" type="button" class="btn" id="btn-normal"><i class="fas fa-arrow-left fa-fw" aria-hidden="true"></i>&nbsp;&nbsp; Back To Normal Search</button>
                </div>
        </div>
        
        <div class="row collapse" id="advance-search">
            <div class="col-sm-12">
                <div class="card" style="padding: 20px;">
                    <h4 class="card-title">Advance Search</h4>
                    <div class="card-body">
                        <form action="{{ action('ExplorePostsController@advance') }}" role="search" method="get">
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
              <div class="card" style="padding: 20px;">
                @if($post->post_cover == null)
                    <img src="http://lorempixel.com/400/200" class="card-img-top" alt="Card image cap" width="100%"/>
                @endif
                @if($post->post_cover != null)
                    <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" class="card-img-top" alt="Card image cap" width="100%"/>
                @endif
                <div class="card-body">
                  <h4 class="card-title"><a href="{{ action('PostsController@show', ['id' => $post->id]) }}">{{$post->post_title}}</a></h4>
                  <p class="card-text">{{$post->description}}</p>
                  <p class="card-text"><small class="text-muted">Category: <a href="/user/explorer/category/{{$post->category}}">{{$post->category}}</a>&nbsp;&nbsp; 
                    @if($post->post_tag != null)
                        Tag : 
                        @foreach($post->tags as $tag)
                            <a href="/user/explorer/tag/{{$tag->slug}}">{{$tag->slug}}</a>
                        @endforeach
                    @endif
                  </small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Post by : <a>{{$post->username}}</a></small></p>
                    <p class="card-text"><small class="text-muted">Created: {{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}
                    &nbsp;Last updated: {{$post->updated_at->format('j F Y')}} at {{$post->updated_at->format('H:m')}}</small>&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($post->files != null)
                        <span style="color: #9A9A9A;"><i class="fas fa-download fa-fw"></i></span>
                    @endif
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
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#explorer').addClass('active');

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
        });
    </script>

    <script type="text/javascript">
	    $('#input-tags').tagsInput();
    </script>

@endsection
