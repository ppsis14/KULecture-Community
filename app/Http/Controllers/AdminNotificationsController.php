<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class AdminNotificationsController extends Controller
{
    public function index() {
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')
        ->where('hidden_status', false)
        ->orderBy('updated_at', 'desc')->paginate(10);
        $count_post = Post::all()->where('report_status', 1)->count();

        // dd($count_post);
        
        return view('layouts.admin.admin-notification', ['count' => $count_post])->withDetails($posts);
    }
}
