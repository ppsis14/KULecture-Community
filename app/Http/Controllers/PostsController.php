<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() {
        return view('layouts.user.posts');
    }

    public function create() {
        return view('layouts.user.create-posts');
    }

    public function update() {
        return view('layouts.user.edit-posts');
    }
}
