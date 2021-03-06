@extends('layouts.admin.admin-master')
@section('title-page', 'Post Notification')
@section('header')
    <i class="pe-7s-bell"></i>&nbsp;&nbsp;Post Notification
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
        @if(count($details) == 0)
            <div class="row">
                <h4 style="text-align: center;">No reported post</h4>
            </div>
        @endif

        <div class="row">
        @if(isset($details))
          @foreach($details as $post)
            @if(($post->report_user == false and $post->report_admin == false) or ($post->report_admin == true and $post->report_user == true))
            <div class="col-sm-6">
            @if( $post->report_user == false and $post->report_admin == false )
              <div class="card" style="padding: 20px;background-color: #ffe5e1;" >
              <h4 class="card-title" style="color: tomato"> <b>This post get report</b> </h4>
              @endif
              
              @if( $post->report_admin == true and $post->report_user == true )
              <div class="card" style="padding: 20px; background-color: #e8f6fe;">
              <h4 class="card-title" style="color: #1DC7EA"> <b>User had edited this post. Check the content!</b> </h4>
              @endif
                @if($post->post_cover == null)
                    <img src="http://lorempixel.com/400/200" class="card-img-top" alt="Card image cap" width="100%"/>
                @endif
                @if($post->post_cover != null)
                    <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" class="card-img-top" alt="Card image cap" width="100%"/>
                @endif
                <div class="card-body">
                  <h4 class="card-title"><a href="{{ action('PostsManagementController@show', ['id' => $post->id]) }}">{{$post->post_title}}</a></h4>
                  <p class="card-text">{{$post->description}}</p>
                  <p class="card-text"><small class="text-muted">Category: <a href="/user/explorer/category/{{$post->category}}">{{$post->category}}</a>&nbsp;&nbsp; 
                    @if($post->post_tag != null)
                        Tag : 
                        @foreach($post->tags as $tag)
                            <a href="/user/explorer/tag/{{$tag->name}}">{{$tag->name}}</a>
                        @endforeach
                    @endif
                  </small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Post by : <a>{{$post->username}}</a></small></p>
                    <p class="card-text"><small class="text-muted">Created: {{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}
                        &nbsp;&nbsp;
                        Last updated: {{$post->updated_at->format('j F Y')}} at {{$post->updated_at->format('H:m')}}</small>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        @if($post->files != null)
                            <span style="color: #9A9A9A;"><i class="fas fa-download fa-fw"></i></span>
                        @endif
                        <ul class="post-action-container">
                            <li>
                                <form action="{{ action('PostsManagementController@destroy', ['id' => $post->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Click to delete this post" type="submit" class="btn delete-post" style="border: transparent; color: tomato;"><i class="fas fa-trash-alt fa-fw"></i></button>
                                </form>
                            </li>
                            <li>
                                    <!-- unhide post -->
                                    @if($post->hidden_status == false) 
                                    <button  style="border: transparent;" class="btn" >
                                        <a href="{{ action('PostsManagementController@hidden', ['id' => $post->id]) }}" title="Click to hide this post">
                                            <i class="fas fa-eye-slash "></i>
                                        </a>
                                    </button>
                                    @endif
                                    <!-- hide post -->
                                    @if($post->hidden_status == true)
                                    <button  style="border: transparent;" class="btn" >
                                        <a href="{{ action('PostsManagementController@unHidden', ['id' => $post->id]) }}" title="Click to unhide this post" >
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
            @endif
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
            $('#notify').addClass('active');

            $('.delete-post').click(function(e) {
                e.preventDefault();
                var is_confirm = confirm('Are you sure to delete this post ?');

                if(is_confirm) {
                    $(e.target).closest('form').submit();
                }
            });
        });
    </script>
@endsection
