<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class AdminNotificationsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    public function index() {
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')
        ->where('report_status', 1)
        ->orderBy('updated_at', 'desc')->paginate(10);
        
        return view('layouts.admin.admin-notification')->withDetails($posts);
    }
}
