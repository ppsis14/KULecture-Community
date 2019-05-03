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

Route::get('/', function () {return view('welcome');});
Route::resource('/user/profile', 'UserProfileController');
Route::post('/user/profile', 'UserProfileController@uploadAvatar');
Route::get('/admin/login', 'AdminsLoginController@index');
// Route::post('/admin/login', 'AdminsLoginController@login');
Route::get('/admin/dashboard', 'AdminDashBoardController@showDashBoard');
Route::get('/admin/users', 'UsersManagementController@index');
Route::get('/admin/posts', 'PostsManagementController@index');
Route::get('/admin/addadmin', 'AddNewAdminController@index');
Route::get('/admin/changepassword', 'ChangePasswordController@index');

Route::get('/user/login', 'UsersLoginController@index');
Route::get('/user/explorer', 'ExplorePostsController@index');
Route::get('/user/explorer/search', 'ExplorePostsController@search');
Route::get('/user/explorer/advance', 'ExplorePostsController@advance');
// Route::get('/user/editprofile', 'EditProfileController@index');
Route::get('/user/home', 'HomeUsersController@index');
Route::get('/user/posts', 'PostsController@index');
Route::get('/user/posts/edit', 'PostsController@update');
Route::get('/user/posts/create', 'PostsController@create');

Route::get('login/google', 'Auth\LoginGoogleController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginGoogleController@handleProviderCallback');
// Route::get('user/logout', 'Auth\LoginGoogleController@logout');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
