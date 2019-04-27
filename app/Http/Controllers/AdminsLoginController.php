<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsLoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    
    public function index(){
        return view('layouts.admin.admin-login');
    }

}

