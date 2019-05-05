<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use DB;

class ExplorePostsController extends Controller
{
    public function index() {

        $posts = Post::where('hidden_status', false)->get();
        // $posts = DB::table('posts')
        // ->join('users', 'posts.user_id', '=', 'users.id')
        // ->select('posts.id', 'posts.user_id', 'posts.post_title', 'posts.post_detail', 'posts.post_tag', 'posts.hidden_status', 'posts.post_cover', 
        // 'posts.description', 'posts.category', 'posts.report_status', 'posts.files', 'posts.updated_at', 'posts.created_at', 'posts.deleted_at',
        // 'users.username')
        // ->get();
        // $posts = DB::table('posts')
        // ->join('users', 'posts.user_id', '=', 'users.id')
        // ->select('posts.*', 'users.username')
        // ->where('hidden_status', false)
        // ->get();
        // dd($posts);
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = 'Category';
        
        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function search(Request $request, $dropdown) 
    {
        $key = $request->input('title');
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];

        if($dropdown == 'Category') {
            $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
            ->where('hidden_status', false)->get();
        }
        else {
            $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
            ->where('category', $dropdown)
            ->where('hidden_status', false)->get();
        }

        if(count($posts) > 0)
            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($key)->withDetails($posts);
        
        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($key);
    }

    public function advance(Request $request) 
    {

        $title = $request->input('post_title');
        $category = $request->input('category');
        $posts = Post::where('post_title', 'LIKE', '%'. $title . '%')
        ->where('category', 'LIKE', '%'. $category . '%')
        ->where('hidden_status', false)->get();

        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];

        $q = $title. ", ". $category;
        if(count($posts) > 0)
            return view('layouts.user.explore', ['categorys' => $categorys])->withQuery($q)->withDetails($posts);
        
        return view('layouts.user.explore', ['categorys' => $categorys])->withMessage('No posts found')->withQuery($q);
    }

    public function category($category) 
    {
        $posts = Post::where('category', $category)
        ->where('hidden_status', false)->get();
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = $category;

        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function tag($tag) 
    {
        $posts = Post::withAnyTag($tag)->where('hidden_status', false)->get();
        // $posts = Post::where('category', $category)
        // ->where('hidden_status', false)->get();
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = '$category';

        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }
}
