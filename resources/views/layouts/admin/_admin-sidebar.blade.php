<div class="logo">
    <a href="{{ action('AdminDashBoardController@showDashBoard') }}" class="simple-text">
        KU NSC
    </a>
</div>

<ul class="nav">
    <li>
        <a href="{{ action('AdminDashBoardController@showDashBoard') }}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li>
        <a href="{{ action('UsersManagementController@index') }}">
            <i class="pe-7s-user"></i>
            <p>User Management</p>
        </a>
    </li>
    <li>
        <a href="{{ action('PostsManagementController@index') }}">
            <i class="pe-7s-news-paper"></i>
            <p>Post Management</p>
        </a>
    </li>
    <li>
        <a href="{{ action('ChangePasswordController@index') }}">
            <i class="pe-7s-key"></i>
            <p>Change Password</p>
        </a>
    </li>
</ul>
