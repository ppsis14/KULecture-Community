<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {return view('index');});

Route::get('login/google', 'Auth\LoginGoogleController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginGoogleController@handleProviderCallback');

Route::get('/admin/login', 'AdminsLoginController@index');
// Route::post('/admin/login', 'AdminsLoginController@login');
Route::post('/admin/insert','AddNewAdminController@store');
Route::get('/admin/login', 'AdminsLoginController@index');
Route::get('/admin/dashboard', 'AdminDashBoardController@showDashBoard');
Route::get('/admin/users', 'UsersManagementController@index');
Route::delete('/admin/users/{id}', 'UsersManagementController@destroy');
Route::get('/admin/addadmin', 'AddNewAdminController@index');
Route::get('/admin/changepassword', 'ChangePasswordController@index');
Route::post('/admin/changepassword','ChangePasswordController@update');
Route::get('/admin/notifications', 'AdminNotificationsController@index');
Route::post('/admin/changepw','ChangePasswordController@update');

// admin manage posts
Route::resource('/admin/posts', 'PostsManagementController'); // display all posts in database
Route::get('/admin/posts/hidden/{id}', 'PostsManagementController@hidden'); // admin hide the post
Route::get('/admin/posts/unhidden/{id}', 'PostsManagementController@unHidden'); // admin unhide the post
Route::post('/admin/posts/unreport/{id}', 'PostsManagementController@unReport'); // admin unreport the post
Route::post('/admin/posts/category/add', 'PostsManagementController@addCategory'); // admin add category

// admin explore posts
Route::get('/admin/explorer', 'AdminExplorePostsController@index'); // display all posts in database
Route::get('/admin/explorer/category/{category}', 'AdminExplorePostsController@choose_category'); // display posts in that category
Route::get('/admin/explorer/search/{category}', 'AdminExplorePostsController@search'); // posts search 
Route::get('/admin/explorer/advance', 'AdminExplorePostsController@advance'); // posts advance search
Route::get('/admin/explorer/tag/{tag}', 'AdminExplorePostsController@tag'); // display posts in that hashtag
Route::get('/admin/explorer/tag', 'AdminExplorePostsController@all_tag'); // display all tags in database


Route::get('/user/login', 'UsersLoginController@index');
Route::resource('/user/home', 'HomeUserController');
Route::resource('/user/profile', 'UserProfileController');

// user explore posts
Route::get('/user/explorer', 'UserExplorePostsController@index'); // display all posts in database that didn't get hide or report
Route::get('/user/explorer/search/{category}', 'UserExplorePostsController@search'); // posts search 
Route::get('/user/explorer/advance', 'UserExplorePostsController@advance'); // posts advance search
Route::get('/user/explorer/category/{category}', 'UserExplorePostsController@choose_category'); // display posts in that category
Route::get('/user/explorer/tag/{tag}', 'UserExplorePostsController@tag'); // display posts in that hashtag
Route::get('/user/explorer/tag', 'UserExplorePostsController@all_tag'); // display all tags in database

// user manage posts
Route::resource('/user/posts', 'PostsController');
Route::get('/user/posts/hidden/{id}', 'PostsController@hidden');
Route::get('/user/posts/unhidden/{id}', 'PostsController@unHidden');
Route::post('/user/posts/report/{id}', 'PostsController@report');
Route::get('/user/posts/download/{file_name}', 'PostsController@download');
Route::get('/user/posts/category/{category}', 'PostsController@choose_category');
Route::get('/user/posts/search/{category}', 'PostsController@search');
Route::get('/user/posts/advance/{id}', 'PostsController@advance');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

//for notification
Route::get('notification','AddNewAdminController@notification');
