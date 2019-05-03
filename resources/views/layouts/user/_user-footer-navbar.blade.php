<ul>
    <li class="active">
        <a href="{{ action('HomeUserController@show', ['id' => Auth::user()->id]) }}">
            Home
        </a>
    </li>
    <li>
        <a href="{{ action('UserProfileController@edit' , ['id' => Auth::user()->id]) }}">
            <p>User Profile</p>
        </a>
    </li>
    <li>
        <a href="{{ action('PostsController@index') }}">
            Posts
        </a>
    </li>
    <li>
        <a href="{{ action('ExplorePostsController@index') }}">
            Explorer
        </a>
    </li>
</ul>
