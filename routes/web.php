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

Route::get('/admin', function () {
    return view('layouts.admin.dashboard');
});

Route::get('/admin/users', function () {
    return view('layouts.admin.user-management');
});

Route::get('/admin/posts', function () {
    return view('layouts.admin.post-management');
});

Route::get('/admin/changepassword', function () {
    return view('layouts.admin.change-password');
});
