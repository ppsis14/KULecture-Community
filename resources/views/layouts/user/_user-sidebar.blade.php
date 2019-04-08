<div class="logo">
    <a href="#" class="simple-text">
        KU NSC
    </a>
</div>

<ul class="nav">
    <li>
        <a href="{{ action('HomeUsersController@index') }}">
            <i class="pe-7s-home"></i>
            <p>Home</p>
        </a>
    </li>
    <li>
        <a href="{{ action('EditProfileController@index') }}">
            <i class="pe-7s-user"></i>
            <p>Edit Profile</p>
        </a>
    </li>
    <li>
        <a href="{{ action('PostsController@index') }}">
            <i class="pe-7s-news-paper"></i>
            <p>Posts</p>
        </a>
    </li>
    <li>
        <a href="{{ action('ExplorePostsController@index') }}">
            <i class="pe-7s-global"></i>
            <p>Explorer</p>
        </a>
    </li>
</ul>
