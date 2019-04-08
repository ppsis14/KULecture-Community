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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'AdminDashBoardController@showDashBoard');
Route::get('/admin/users', 'UsersManagementController@index');
Route::get('/admin/posts', 'PostsManagementController@index');
Route::get('/admin/changepassword', 'ChangePasswordController@index');

Route::get('/user/explorer', 'ExplorePostsController@index');
Route::get('/user/editprofile', 'EditProfileController@index');
Route::get('/user/home', 'HomeUsersController@index');
Route::get('/user/posts', 'PostsController@index');
Route::get('/user/posts/edit', 'PostsController@update');
Route::get('/user/posts/create', 'PostsController@create');
