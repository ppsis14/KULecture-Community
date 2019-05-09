<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Charts\PostType;
use App\Charts\LoginChart;
use App\Category;
use Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;

class AdminDashBoardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    public function showDashBoard(){
        if(Gate::allows('isAdmin')){
        $users = User::where('role', 'USER')->count();
        $posts = Post::all();
        $categories = Category::all('name');
        $allCategories = array();
        $colorCollection = new Collection();

        foreach ($categories as $category => $name) {
            array_push($allCategories, $name['name']);
        }
        // dd($allCategories);

        $postChart = new PostType;
        $postChart->labels($allCategories);
        $posts_count = array();
        foreach ($allCategories as $key) {
            $data = Post::where('category', $key)->count();
            array_push($posts_count, $data);
            
        }

        for ($i=0; $i < count($allCategories); $i++) { 
            $color = sprintf( "#%06X\n", mt_rand( 0, 0xFFFFFF ));
            if(!$colorCollection->contains($color)){
                $colorCollection->push($color);
            }
            else{
                $i--;
            }
        }

        $postData =  $postChart->dataset('Post Stats', 'pie', $posts_count);
        // $postData->backgroundColor(collect(["#003f5c", "#374c80", "#7a5195", "#bc5090", "#ef5675", "#ff764a", "#ffa600"]));
        $postData->backgroundColor($colorCollection);
        $postChart->displayAxes(false);

        $loginChart = new LoginChart;
        $loginChart->labels(['00-03 น.', '03-06 น.', '06-09 น.', '09-12 น.', '12-15 น.', '15-18 น.', '18-21 น.', '21-23:59 น.']);
        $time_start = ['00:00:00', '03:00:01', '06:00:01', '09:00:01', '12:00:01', '15:00:01', '18:00:01', '21:00:01'];
        $time_end = ['03:00:00', '06:00:00', '09:00:00', '12:00:00', '15:00:00', '18:00:00', '21:00:00', '23:59:59'];
        $login_count = array();
        for ($i=0; $i < count($time_start); $i++) { 
            $usersLogin = User::where('role', 'USER')
            ->whereDate('login_time', '=', now())
            ->whereTime('login_time','>=',$time_start[$i])
            ->whereTime('login_time','<=',$time_end[$i])
            ->count();
            array_push($login_count, $usersLogin);
        }
            
        $loginData = $loginChart->dataset('Users', 'line', $login_count);
        $loginData->backgroundColor('#41cdf4');
        

        return view('layouts.admin.dashboard', ['users' => $users, 'posts' => $posts->count(), 'postChart' => $postChart, 'loginChart' => $loginChart]);
        }
        else{
            return abort(403, 'Unauthorized action.');
        }
    }

    public function colorRandom() {
        $color = sprintf( "#%06X\n", mt_rand( 0, 0xFFFFFF ));
        return $color;
    }

}
