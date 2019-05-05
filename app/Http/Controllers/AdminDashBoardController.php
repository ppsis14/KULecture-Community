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
        $chart->labels(['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others']);
        $dataset =  $chart->dataset('My dataset 1', 'pie', [10, 20, 10, 5, 15, 10, 10]);
        $dataset->backgroundColor(collect(["#003f5c", "#374c80", "#7a5195", "#bc5090", "#ef5675", "#ff764a", "#ffa600"]));
        $chart->displayAxes(false);

        return view('layouts.admin.dashboard', ['users' => $users, 'posts' => $posts, 'chart' => $chart]);
    }

}
