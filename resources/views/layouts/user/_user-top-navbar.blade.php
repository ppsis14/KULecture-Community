<div class="collapse navbar-collapse">

    @php        
        $posts = \App\Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')
        ->join('report_posts', 'posts.id', '=', 'report_posts.post_id')
        ->select('posts.*', 'report_posts.report_user', 'report_posts.report_admin')
        ->where('user_id', Auth::user()->id)
        ->where('report_user', true)
        ->where('report_status', true)->get();
        $count = count($posts);
    @endphp

    <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-globe"></i>
                <b class="caret hidden-sm hidden-xs"></b>
                @if($count != 0)
                    <span class="notification hidden-sm hidden-xs"> {{$count}}</span>
                
				<p class="hidden-lg hidden-md">
					5 Notifications
					<b class="caret"></b>
				</p>
                @endif
            </a>

            @if($count != 0)
            <ul class="dropdown-menu">
                @foreach ( $posts as $post) 
                    <li><a href="{{ action('PostsController@show', ['id' => $post->id]) }}"> Your post title <b>{{$post->post_title}}</b> was reported from another user   </a></li>
                @endforeach
            </ul>
            @endif
            
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="#" class="username">
                <i class="fas fa-user-circle fa-fw"></i>&nbsp;&nbsp;{{ Auth::user()->username }}
            </a>
        </li>
        <li>
            <a class="" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="separator hidden-lg"></li>
    </ul>
</div>
