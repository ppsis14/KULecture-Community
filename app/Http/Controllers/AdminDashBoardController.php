<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Charts\PostType;

class AdminDashBoardController extends Controller
{
    public function showDashBoard(){
        $users = User::where('role', 'USER')->count();
        $posts = Post::all()->count();

        $chart = new PostType;

        $chart->labels(["หนังสือ", "เลคเชอร์", "หอพัก"]);
        $chart->dataset('Post Chart', 'donut' ,[10, 20, 15]);

        return view('layouts.admin.dashboard', ['users' => $users, 'posts' => $posts, 'chart' => $chart]);
    }

}
