<div class="logo">
    <a href="{{ action('AdminDashBoardController@showDashBoard') }}" class="simple-text">
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
        <a href="{{ action('AddNewAdminController@index')}}">
            <i class="pe-7s-add-user"></i>
            <p>Add new admin</p>
        </a>
    </li>
    <li>
        <a href="{{ action('ChangePasswordController@index') }}">
            <i class="pe-7s-key"></i>
            <p>Change Password</p>
        </a>
    </li>
</ul>
