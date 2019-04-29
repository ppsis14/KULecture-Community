<div class="logo">
    <a href="{{ action('HomeUsersController@index') }}" class="simple-text">
        <div class="form-title">
            <div class="name-box">
                <div class="name">KU NSC</div>
                <h6 class="full-name">KU Knowledge Share Community</h6>
            </div>
        </div>
    </a>
    <br>
</div>

<ul class="nav">
    <li id="home">
        <a href="{{ action('HomeUsersController@index') }}">
            <i class="pe-7s-home"></i>
            <p>Home</p>
        </a>
    </li>
    <li id="profile">
        <a href="{{ action('UserProfileController@show' , ['id' => Auth::user()->id]) }}">
            <i class="pe-7s-user"></i>
            <p>User Profile</p>
        </a>
    </li>
    <li id="posts">
        <a href="{{ action('PostsController@index') }}">
            <i class="pe-7s-news-paper"></i>
            <p>Posts</p>
        </a>
    </li>
    <li id="explorer">
        <a href="{{ action('ExplorePostsController@index') }}">
            <i class="pe-7s-global"></i>
            <p>Explorer</p>
        </a>
    </li>
</ul>
