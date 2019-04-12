<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersLoginController extends Controller
{
    public function index(){
        return view('layouts.user.user-login');
    }
}
