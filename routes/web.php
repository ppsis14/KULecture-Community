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
Route::get('/', function () {return view('welcome');});
Route::get('/admin/login', 'AdminsLoginController@index');
// Route::post('/admin/login', 'AdminsLoginController@login');
Route::post('/admin/insert','AddNewAdminController@store');
Route::get('/admin/dashboard', 'AdminDashBoardController@showDashBoard');
Route::get('/admin/users', 'UsersManagementController@index');
Route::get('/admin/posts', 'PostsManagementController@index');
Route::get('/admin/addadmin', 'AddNewAdminController@index');
Route::get('/admin/changepassword', 'ChangePasswordController@index');
Route::post('/admin/changepw','ChangePasswordController@update');
Route::get('/user/login', 'UsersLoginController@index');
Route::get('/user/explorer', 'ExplorePostsController@index');
Route::get('/user/explorer/search', 'ExplorePostsController@search');
Route::get('/user/explorer/advance', 'ExplorePostsController@advance');
Route::resource('/user/posts', 'PostsController');
Route::get('/user/posts/hidden/{id}', 'PostsController@hidden');
Route::get('/user/posts/report/{id}', 'PostsController@report');
Route::get('/user/posts/download/{file_name}', 'PostsController@download');
Route::get('login/google', 'Auth\LoginGoogleController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginGoogleController@handleProviderCallback');
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

//for notification
Route::get('notification','AddNewAdminController@notification');
