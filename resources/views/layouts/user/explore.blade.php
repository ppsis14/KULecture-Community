@extends('layouts.user.user-master')
@section('title-page', 'Posts Explorer')
@section('header')
    <i class="pe-7s-global"></i>&nbsp;&nbsp;Posts Explorer
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row" id="normal-search">
            <div class="col-md-2">
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <p>
                                {{$dropdown}}
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
            </div>
            <div class="col-md-4">
                <form action="{{ action('ExplorePostsController@search', ['dropdown' => $dropdown]) }}" role="search" method="get">
                <div class="col-md-10">
                    <div class="form-group"> 
                        <input class="form-control" type="text" name="title" placeholder="Search..." aria-label="Search" value="{{ old('title')}}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <button type="submit" class="btn" name="button" id="btn-search"><i class="fas fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="row" id="normal-search">
            <div class="col-md-3">
                    <div class="form-group">
                        <button type="button" class="btn" name="button" id="btn-advance"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Advance Search</button>
                    </div>
            </div>
        </div>

        <div >
            @if(isset($query))
            <p>The search result for <b>{{ $query }}</b> are :</p>
            @endif
        </div>
        <div class="row" id="advance-search">
            <div class="col-sm-12">
                <div class="card" style="padding: 20px;">
                    <h4 class="card-title">Advance Search</h4>
                    <div class="card-body">
                        <form action="{{ action('ExplorePostsController@advance') }}" role="search" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Post Title</label>
                                        <input type="text" class="form-control" name="post_title">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label><br>
                                        <select class="form-control" id="category" name="category" value="{{ old('category')}}">
                                            @foreach($categorys as $category)
                                                <option value="{{ $category}}" >{{ $category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Search</button>
                            <button type="button" class="btn btn-success btn-fill pull-left" id="btn-normal">Normal Search</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
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
                            <a href="/user/explorer/tag/{{$tag->slug}}">#{{$tag->slug}}</a>
                        @endforeach
                    @endif
                  </small></p>
                  <hr>
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
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#explorer').addClass('active');

            $('#advance-search').hide();

            $('#btn-advance').click(function () {
                $('#advance-search').show();
                $('#normal-search').hide();
            });

            $('#btn-normal').click(function () {
                $('#advance-search').hide();
                $('#normal-search').show();
            });
        });
    </script>
@endsection
