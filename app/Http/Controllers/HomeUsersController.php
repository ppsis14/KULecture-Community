<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeUsersController extends Controller
{
    public function index() {
        return view('layouts.user.home');
    }
}
