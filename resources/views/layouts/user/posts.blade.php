@extends('layouts.user.user-master')
@section('title-page', 'User Posts')
@section('header')
    <i class="pe-7s-news-paper"></i>&nbsp;&nbsp;Posts
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row" id="normal-search">
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

            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn" name="button" id="btn-advance"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Advance Search</button>
                </div>
            </div>
        </div>
        <div class="row" id="advance-search">
            <div class="col-sm-12">
                <div class="card" style="padding: 20px;">
                    <h4 class="card-title">Advance Search</h4>
                    <div class="card-body">
                        <form class="">
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

        <!-- @if(isset($details))
            @if($details == null)
            <div class="row">
                <h4 style="text-align: center;">No posts</h4>
            </div>
            @endif
        @endif -->

        <div class="row">
            @foreach($details as $post)
                <div class="col-sm-6">
                @if($post->report_status == true)
                    <div class="card" style="padding: 20px; background-color: #ffe5e1;">
                @endif
                @if($post->report_status == false)
                    <div class="card" style="padding: 20px;">
                @endif
                @if($post->post_cover == null)
                    <img src="http://lorempixel.com/400/200" class="card-img-top" alt="Card image cap" width="545" height="auto"/>
                @endif
                @if($post->post_cover != null)
                    <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" class="card-img-top" alt="Card image cap" width="545" height="auto"/>
                @endif
                    <div class="card-body">
                    <h4 class="card-title"><a href="{{ action('PostsController@show', ['id' => $post->id]) }}">{{$post->post_title}}</a></h4>
                    <p class="card-text">{{$post->description}}</p>
                    <br>
                    <p class="card-text"><small class="text-muted">Category: <a>{{$post->category}}</a>&nbsp;&nbsp; Tag : 
                        @foreach($post->tags as $tag)
                            <a >#{{$tag->slug}}</a>
                        @endforeach
                    </small></p>
                    <p class="card-text"><small class="text-muted">Created: {{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}
                    &nbsp;Last updated: {{$post->updated_at->format('j F Y')}} at {{$post->updated_at->format('H:m')}}</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;10</span></p>
                    <hr>
                    <p> 
                        <div class="col-md-2">
                            <button style="border: transparent;" class="btn">
                                <a href="{{ action('PostsController@edit', ['id' => $post->id]) }}" title="Click to edit this post">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                            </button>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-md-2">
                            <form action="{{ action('PostsController@destroy', ['id' => $post->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button title="Click to delete this post" type="submit" class="btn delete-post" style="border: transparent; color: tomato;"><i class="fas fa-trash-alt fa-fw"></i></button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            @if($post->hidden_status == false)
                                <button  style="border: transparent;" class="btn">
                                    <a href="{{ action('PostsController@hidden', ['id' => $post->id]) }}" title="Click to hide this post">
                                        <i class="fas fa-eye-slash "></i>
                                    </a>
                                </button>
                            @endif
                            @if($post->hidden_status == true)
                                <button  style="border: transparent;" class="btn">
                                    <a href="{{ action('PostsController@hidden', ['id' => $post->id]) }}" title="Click to show this post" >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </button>
                            @endif
                        </div>
                    </p>
                    </div>
                </div>
                </div>   
            @endforeach
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
