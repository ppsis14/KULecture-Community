<ul>
    <li>
        <a href="{{ action('AdminDashBoardController@showDashBoard') }}">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ action('UsersManagementController@index') }}">
            User Management
        </a>
    </li>
    <li>
        <a href="{{ action('PostsManagementController@index') }}">
            Post Management
        </a>
    </li>
    <li>
        <a href="{{ action('AddNewAdminController@index') }}">
            Add New Admin
        </a>
    </li>
    <li>
        <a href="{{ action('ChangePasswordController@index') }}">
            Change Password
        </a>
    </li>
</ul>
