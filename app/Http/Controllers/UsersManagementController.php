<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersManagementController extends Controller
{
    public function index() {
        return view('layouts.admin.user-management');
    }
}
