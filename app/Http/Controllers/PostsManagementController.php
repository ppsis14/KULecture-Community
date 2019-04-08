<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsManagementController extends Controller
{
    public function index() {
        return view('layouts.admin.post-management');
    }
}
