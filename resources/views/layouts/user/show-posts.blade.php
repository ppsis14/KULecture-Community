@extends('layouts.user.user-master')
@section('title-page', 'User Post')
@section('header', 'Post')
@section('content')
    <div class="content" id="app">
        <div class="container-fluid">
            <div class="card" style="padding: 20px;">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                        @if($post->post_cover == null)
                            <img src="http://lorempixel.com/640/480/" class="card-img-top" alt="Card image cap" width="100%"/>
                        @endif
                        @if($post->post_cover != null)
                            <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" class="card-img-top" alt="Card image cap" width="100%"/>
                        @endif
                        </div>
                        <div class="col-md-6">

                        @if(Auth::user() and Auth::user()->can('view', $post))
                            @if($post->report_status == true)
                                @if($post->user_id == Auth::user()->id && ($report_post->report_user == true && $report_post->report_admin == false))
                                    <button type="button" class="btn btn-danger">
                                        <b> This post get report! </b>
                                    </button>
                                @endif
                                @if($post->user_id == Auth::user()->id && ($report_post->report_user == true && $report_post->report_admin == true))
                                    <button type="button" class="btn btn-danger">
                                        <b> Waiting for admin to unreport. </b>
                                    </button>
                                @endif
                                @if($post->user_id != Auth::user()->id)
                                    @foreach($comments as $comment)
                                        @if($comment->user_id == Auth::user()->id && $comment->unreport_status == false)
                                        <button type="button" class="btn btn-danger">
                                            <b> You had report this post </b>
                                        </button>
                                        @endif
                                    @endforeach
                                @endif
                                
                            @endif
                            @if($post->hidden_status == true)
                                @if($post->user_id == Auth::user()->id)
                                    <button type="button" class="btn btn-info">
                                        <b> This post is hidden. </b>
                                    </button>
                                @endif
                            @endif
                        @endif

                            <h2> <b> {{$post->post_title}} </b></h2>
                            <p class="card-text">{{$post->description}}</p>
                            <p class="card-text"><small class="text-muted">Category: <a href="/user/explorer/category/{{$post->category}}">{{$post->category}}</a>&nbsp;&nbsp; Tag :
                            @foreach($post->tags as $tag)
                                <a href="/user/explorer/tag/{{$tag->name}}">{{$tag->name}}</a>
                            @endforeach
                            </small></p>
                            <p class="card-text"><small class="text-muted">Post by : <a>
                                @foreach($username as $user)
                                    {{$user->username}}
                                @endforeach
                            </a></small></p>
                            <p class="card-text"><small class="text-muted">
                                Created: {{$post->created_at->format('j F Y')}} at {{$post->created_at->format('H:m')}}
                                &nbsp;Last updated: {{$post->updated_at->format('j F Y')}} at {{$post->updated_at->format('H:m')}}
                            </small>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <br>
                            <div class="row">
                                @if(Auth::user() and Auth::user()->can('update', $post))
                                    <div class="col-md-2">
                                        <button style="border: transparent;" class="btn btn-default btn-block">
                                            <a href="{{ action('PostsController@edit', ['id' => $post->id]) }}" title="Click to edit this post">
                                                <i class="fas fa-edit fa-fw"></i> Edit
                                            </a>
                                        </button>
                                    </div>
                                @endif

                                @if(Auth::user() and Auth::user()->can('delete', $post))
                                <div class="col-md-2">
                                    <form action="{{ action('PostsController@destroy', ['id' => $post->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button style="border: transparent; color: tomato;" type="submit" class="btn btn-default btn-block delete-post" ><i class="fas fa-trash-alt fa-fw"></i> Delete</button>
                                    </form>
                                </div>
                                @endif

                                
                                @if(Auth::user() and Auth::user()->can('hide', $post) and Auth::user()->can('unHide', $post))
                                    <div class="col-md-2">
                                        @if($post->hidden_status == false)
                                            <button style="border: transparent;" class="btn btn-default btn-block" >
                                                <a href="{{ action('PostsController@hidden', ['id' => $post->id]) }}" title="Click to hide this post">
                                                    <i class="fas fa-eye-slash "></i> Hidden
                                                </a>
                                            </button>
                                        @endif

                                        @if($post->hidden_status == true)
                                            <button  style="border: transparent;" class="btn btn-default btn-block" >
                                                <a href="{{ action('PostsController@unHidden', ['id' => $post->id]) }}" title="Click to unhide this post" >
                                                    <i class="fas fa-eye"></i> Unhide
                                                </a>
                                            </button>
                                        @endif
                                    </div>
                                @endif   
                                
                                
                                @if(Auth::user() and Auth::user()->can('report', $post))
                                    @php
                                        $count = 0
                                    @endphp
                                    @foreach($comments as $comment)
                                        @if($comment->user_id == Auth::user()->id && $comment->unreport_status == false)
                                            @php
                                                $count += 1
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if($count == 0) 
                                    <div class="col-md-2">
                                        <a href="#popupLogin" data_real="popup" data-position-to="window"
                                            data-transaction="pop" >
                                            <button  style="border: transparent; color: tomato;" class="btn btn-default btn-block report-post-btn">
                                                <i class="fas fa-flag"></i> &nbsp;Report
                                            </button>
                                        </a>
                                    </div>
                                    @endif
                                @endif

                                @if($post->report_status == true)
                                    @if($post->user_id == Auth::user()->id && ($report_post->report_user == true && $report_post->report_admin == false))
                                    <div class="col-md-2">
                                        <a href="{{ action('PostsController@report_to_admin', ['id' => $post->id]) }}" data_real="popup" data-position-to="window"
                                            data-transaction="pop" >
                                            <button  style="border: transparent; color: tomato;" class="btn btn-default btn-block report-post-btn">
                                                <i class="fas fa-flag"></i> &nbsp;Send message to admin
                                            </button>
                                        </a>
                                    </div>
                                    @endif
                                @endif

                            </div>
                            @if(Auth::user() and Auth::user()->can('report', $post))
                                <br>
                                <div class="row report" style="display: none">
                                    <form action="{{ action('PostsController@report', ['id' => $post->id]) }}" method="post">
                                    @csrf
                                        <textarea name="report-message" id="report-message" class="form-control" placeholder="type the message.." style="height: 80px; width: 500px; margin: auto;"></textarea>
                                        <br><button type="submit" class="btn btn-fill pull-right report-post-submit" style="border: transparent;background-color: tomato;">Send</button>
                                    </form>
                                </div>
                                @if ($errors->has('report-message'))
                                    <div class="invalid-feedback" style="color: red">
                                        {{ $errors->first('report-message')}}
                                    </div>
                                @endif 
                            @endif
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
                            <button  style="background-color: #1DC7EA; border: transparent;" class="btn">
                                <a style="color: white" href="/user/posts/download/{{$file}}"><i class="fas fa-download"></i>&nbsp;&nbsp;{{$file}}</a> 
                            </button><br><br>
                        @endforeach
                        
                    </div>
                </div>
            @endif
            <div class="card" style="padding: 20px;">
                <h5>Contact</h5>
                <div class="content">
                    <ul class="social-container">
                        <li>
                            @foreach($email as $e)
                                <i class="fas fa-envelope fa-fw"></i>&nbsp;&nbsp; {{$e->email}}
                            @endforeach
                        </li>

                        @if(!is_null($contact->facebook))
                        <li>
                            <img src="/img/icon-img/icons8-facebook.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="{{ $contact->facebook }}" target="_blank">{{ $contact->facebook_username }}</a></span>
                        </li>
                        @endif
                        @if(!is_null($contact->instagram))
                        <li>
                            <img src="/img/icon-img/icons8-instagram.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="{{ $contact->instagram }}" target="_blank">{{ $contact->instagram_username }}</a></span>
                        </li>
                        @endif
                        @if(!is_null($contact->twitter))
                        <li>
                            <img src="/img/icon-img/icons8-twitter.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="{{ $contact->twitter }}" target="_blank">{{ $contact->twitter_username }}</a></span>
                        </li>
                        @endif
                        @if(!is_null($contact->line))
                        <li>
                            <img src="/img/icon-img/icons8-line.svg" class="img-icon">&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $contact->line }}</span>
                        </li>
                        @endif
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.delete-post').click(function(e) {
                e.preventDefault();
                var is_confirm = confirm('Are you sure to delete this post ?');

                if(is_confirm) {
                    $(e.target).closest('form').submit();
                }
            });

            $('.report-post-submit').click(function(e) {
                e.preventDefault();
                var is_confirm = confirm('Are you sure to report this post ?');

                if(is_confirm) {
                    $(e.target).closest('form').submit();
                }
            });

            $('.report-post-btn').click(function(e) {
                $('.report').show();
            });

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

    <script type="text/javascript">
        if( {{$errors->has('report-message')}} ){
            $('.report').show();
        }
    </script>
@endsection