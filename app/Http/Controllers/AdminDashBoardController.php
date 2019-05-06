<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Charts\PostType;
use Illuminate\Support\Facades\Gate;

class AdminDashBoardController extends Controller
{
    public function showDashBoard(){
        if(Gate::allows('isAdmin')){
        $users = User::where('role', 'USER')->count();
        $posts = Post::all();
        $category = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        $chart = new PostType;
        $chart->labels($category);
        $posts_count = array();
        foreach ($category as $key) {
            $data = Post::where('category', $key)->count();
            array_push($posts_count, $data);
        }
        $dataset =  $chart->dataset('My dataset 1', 'pie', $posts_count);
        $dataset->backgroundColor(collect(["#003f5c", "#374c80", "#7a5195", "#bc5090", "#ef5675", "#ff764a", "#ffa600"]));
        $chart->displayAxes(false);

        return view('layouts.admin.dashboard', ['users' => $users, 'posts' => $posts->count(), 'chart' => $chart]);
        }
        else{
            return abort(404);
        }
    }

}
