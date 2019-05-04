@extends('layouts.user.user-master')
@section('title-page', 'User Edit Post')
@section('header', 'Post')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card" style="padding: 20px;">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                        @if($post->post_cover == null)
                            <img src="http://lorempixel.com/640/480/" class="card-img-top" alt="Card image cap" width="545" height="auto"/>
                        @endif
                        @if($post->post_cover != null)
                            <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" class="card-img-top" alt="Card image cap" width="545" height="auto"/>
                        @endif
                        </div>
                        <div class="col-md-6">
                        @if($post->report_status == true)
                            <h4 style="color: red"> <b> Your post get report! </b></h4>
                        @endif
                            <h2> <b> {{$post->post_title}} </b></h2>
                            <p class="card-text">{{$post->description}}</p>
                            <p class="card-text"><small class="text-muted">Category: <a>{{$post->category}}</a>&nbsp;&nbsp; Tag :
                            @foreach($post->tags as $tag)
                                <a >#{{$tag->slug}}</a>
                            @endforeach
                            </small></p>
                            <p class="card-text"><small class="text-muted">Post by : <a>{{$post->username}}</a></small></p>
                            <p class="card-text"><small class="text-muted">
                                Created: {{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}
                                &nbsp;Last updated: {{$post->updated_at->format('j F Y')}} at {{$post->updated_at->format('H:m')}}
                            </small>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <button style="border: transparent;" class="btn btn-default btn-block">
                                        <a href="{{ action('PostsController@edit', ['id' => $post->id]) }}" title="Click to edit this post">
                                            <i class="fas fa-edit fa-fw"></i> Edit
                                        </a>
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ action('PostsController@destroy', ['id' => $post->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button  style="border: transparent; color: tomato;" type="submit" class="btn btn-default btn-block" ><i class="fas fa-trash-alt fa-fw"></i> Delete</button>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    @if($post->hidden_status == false)
                                        <button  style="border: transparent;" class="btn btn-default btn-block">
                                            <a href="{{ action('PostsController@hidden', ['id' => $post->id]) }}" title="Click to hide this post">
                                                <i class="fas fa-eye-slash "></i> Hidden
                                            </a>
                                        </button>
                                    @endif
                                    @if($post->hidden_status == true)
                                        <button  style="border: transparent;" class="btn btn-default btn-block">
                                            <a href="{{ action('PostsController@hidden', ['id' => $post->id]) }}" title="Click to show this post" >
                                                <i class="fas fa-eye"></i> Show
                                            </a>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button  style="border: transparent; color: tomato;" class="btn btn-default btn-block">
                                        <a href="{{ action('PostsController@report', ['id' => $post->id]) }}" style="color: tomato;" title="Click to repost this post">
                                            <i class="fas fa-flag"></i> &nbsp;Report
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="padding: 20px;">
                <h5>Detail</h5>
                <div class="content">
                    @php
                        echo $post->post_detail;
                    @endphp
                    
                </div>
            </div>

            @if ($files != null)
                <div class="card" style="padding: 20px;">
                    <h5>Download file</h5>
                    <div class="content">
                        @php
                            $count = 0
                        @endphp
                        @foreach($files as $file)
                            @php
                                $count += 1
                            @endphp
                            
                            <button  style="background-color: #1DC7EA; border: transparent;" class="btn">
                                <a style="color: white" href="/user/posts/download/{{$file}}"><i class="fas fa-download"></i>&nbsp;&nbsp;Click to download file 
                                    @php
                                        echo $count
                                    @endphp 
                                </a> 
                            </button><br><br>
                        @endforeach
                        
                    </div>
                </div>
            @endif
            <div class="card" style="padding: 20px;">
                <h5>Contact</h5>
                <div class="content">
                    <!-- @php
                        echo $post->post_detail;
                    @endphp -->
                    
                </div>
            </div>
        </div>
    </div>
@endsection