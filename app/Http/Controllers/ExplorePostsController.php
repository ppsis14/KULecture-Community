<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplorePostsController extends Controller
{
    public function index() {
        return view('layouts.user.explore');
    }
}
