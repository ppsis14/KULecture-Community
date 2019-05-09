@extends('layouts.admin.admin-master')
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
                                @if($report_post->report_admin == true && $report_post->report_user == true)
                                    <button type="button" class="btn btn-danger">
                                        <b> User had edited this post please check the detail.</b>
                                    </button>
                                @endif
                                @if($report_post->report_admin == false && $report_post->report_user == true)
                                    <button type="button" class="btn btn-danger">
                                        <b> Waiting for user edit their post detail.</b>
                                    </button>
                                @endif
                                @if($report_post->report_admin == false && $report_post->report_user == false)
                                    @if($comment_count == 1)
                                    <button type="button" class="btn btn-danger">
                                        <b> This post get report from {{ $comment_count }} user!</b> <br>
                                        Check the detail and report to user and let them edit his/her post. <br>
                                        Or hide or delete this post.
                                    </button>
                                    @endif
                                    @if($comment_count > 1)
                                    <button type="button" class="btn btn-danger">
                                        <b> This post get report from {{ $comment_count }} users!</b>
                                    </button>
                                    @endif
                                @endif  
                            @endif
                            @if($post->hidden_status == true)
                                <button type="button" class="btn btn-info">
                                    <b> This post is hidden. </b>
                                </button>
                                
                            @endif
                        @endif

                            <h2> <b> {{$post->post_title}} </b></h2>
                            <p class="card-text">{{$post->description}}</p>
                            <p class="card-text"><small class="text-muted">Category: <a href="/admin/posts/category/{{$post->category}}">{{$post->category}}</a>&nbsp;&nbsp; Tag :
                            @foreach($post->tags as $tag)
                                <a href="/admin/posts/tag/{{$tag->name}}">{{$tag->name}}</a>
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
                                @if(Auth::user() and Auth::user()->can('delete', $post))
                                <div class="col-md-2">
                                    <form action="{{ action('PostsManagementController@destroy', ['id' => $post->id]) }}" method="post">
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
                                                <a href="{{ action('PostsManagementController@hidden', ['id' => $post->id]) }}" title="Click to hide this post">
                                                    <i class="fas fa-eye-slash "></i> Hidden
                                                </a>
                                            </button>
                                        @endif

                                        @if($post->hidden_status == true)
                                            <button  style="border: transparent;" class="btn btn-default btn-block" >
                                                <a href="{{ action('PostsManagementController@unHidden', ['id' => $post->id]) }}" title="Click to unhide this post" >
                                                    <i class="fas fa-eye"></i> Unhide
                                                </a>
                                            </button>
                                        @endif
                                    </div>
                                @endif   
                                @if(Auth::user() and Auth::user()->can('unReport', $post))
                                    @if($post->report_status == true && $report_post->report_admin == true && $report_post->report_user == true)
                                    <div class="col-md-2">
                                        <form action="{{ action('PostsManagementController@unReport', ['id' => $post->id]) }}" method="post">
                                        @csrf
                                        <button  style="border: transparent; color: tomato;" class="btn btn-default btn-block unreport-post" >
                                            <i class="fas fa-flag"></i> &nbsp;Unreport
                                        </button>
                                        </form>
                                    </div>
                                    @endif
                                        @if($post->report_status == true and ($report_post->report_admin == true or $report_post->report_user == false))
                                        <div class="col-md-2">
                                            <button style="border: transparent;" class="btn btn-default btn-block" >
                                                <a href="{{ action('PostsManagementController@report_to_user', ['id' => $post->id]) }}">
                                                    <i class="fas fa-flag"></i> Report to owner
                                                </a>
                                            </button>
                                        </div>
                                        @endif
                                @endif

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

            @if($comment_count != 0)
                <div class="card" style="padding: 20px;">
                    <h5>Report Comments</h5> <br>
                    @foreach($comments as $comment)
                        <div class="card" style="padding: 20px;">
                            <p class="card-title"><b>From:</b> {{ $comment->username }} <small class="text-muted">{{$comment->created_at->format('j F Y')}} at {{$comment->created_at->format('H:m')}}</small> </p>
                            <p class="card-text">{{$comment->detail}}</p>
                        </div>
                    @endforeach
                </div>
            @endif
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

            $('.report-post').click(function(e) {
                e.preventDefault();
                var is_confirm = confirm('Are you sure to report this post ?');

                if(is_confirm) {
                    $(e.target).closest('form').submit();
                }
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
@endsection