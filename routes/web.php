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
Route::resource('/user/home', 'HomeUserController');
Route::resource('/user/profile', 'UserProfileController');

Route::get('/admin/login', 'AdminsLoginController@index');
// Route::post('/admin/login', 'AdminsLoginController@login');
Route::post('/admin/insert','AddNewAdminController@store');

Route::get('/', function () {return view('index');});

Route::get('/admin/login', 'AdminsLoginController@index');
Route::get('/admin/dashboard', 'AdminDashBoardController@showDashBoard');
Route::get('/admin/users', 'UsersManagementController@index');
Route::delete('/admin/users/{id}', 'UsersManagementController@destroy');
Route::resource('/admin/posts', 'PostsManagementController');
Route::get('/admin/posts/hidden/{id}', 'PostsManagementController@hidden');
Route::get('/admin/posts/unhidden/{id}', 'PostsManagementController@unHidden');
Route::post('/admin/posts/unreport/{id}', 'PostsManagementController@unReport');
Route::get('/admin/addadmin', 'AddNewAdminController@index');
Route::get('/admin/changepassword', 'ChangePasswordController@index');

Route::post('/admin/changepassword','ChangePasswordController@update');
Route::get('/admin/notifications', 'AdminNotificationsController@index');
Route::post('/admin/changepw','ChangePasswordController@update');

Route::get('/user/login', 'UsersLoginController@index');
Route::get('/user/explorer', 'ExplorePostsController@index');
Route::get('/user/explorer/search/{category}', 'ExplorePostsController@search');
Route::get('/user/explorer/advance', 'ExplorePostsController@advance');
Route::get('/user/explorer/category/{category}', 'ExplorePostsController@category');

Route::get('/user/explorer/tag/{tag}', 'TagsController@show');
Route::get('/user/explorer/tag/advance', 'TagsController@advance');
Route::get('/user/explorer/tag', 'TagsController@index');

Route::resource('/user/posts', 'PostsController');
Route::get('/user/posts/hidden/{id}', 'PostsController@hidden');
Route::get('/user/posts/unhidden/{id}', 'PostsController@unHidden');
Route::post('/user/posts/report/{id}', 'PostsController@report');
Route::get('/user/posts/download/{file_name}', 'PostsController@download');
Route::get('/user/posts/category/{category}', 'PostsController@category');
Route::get('/user/posts/search/{category}', 'PostsController@search');
Route::get('/user/posts/advance/{id}', 'PostsController@advance');

Route::get('login/google', 'Auth\LoginGoogleController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginGoogleController@handleProviderCallback');
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

//for notification
Route::get('notification','AddNewAdminController@notification');
