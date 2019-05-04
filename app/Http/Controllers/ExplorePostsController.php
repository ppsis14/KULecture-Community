<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ExplorePostsController extends Controller
{
    public function index() {

        $posts = Post::where('hidden_status', false)->get();
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        return view('layouts.user.explore', ['categorys' => $categorys])->withDetails($posts);
    }

    public function search(Request $request) {

        $key = $request->input('title');
        $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
        ->where('hidden_status', false)->get();

        if(count($posts) > 0)
            return view('layouts.user.explore')->withQuery($key)->withDetails($posts);
            // return view('layouts.user.explore', ['posts' => $posts])->withQuery($key)->withDetail($posts);
        
        // return view('layouts.user.explore')->withMessage('No posts found')->withQuery($key);
        return redirect()->action('ExplorePostsController@index')->withMessage('No posts found')->withQuery($key);
    }

    public function advance(Request $request) {

        $title = $request->input('post_title');
        $category = $request->input('category');
        $posts = Post::where('post_title', 'LIKE', '%'. $title . '%')
        ->where('category', 'LIKE', '%'. $category . '%')
        ->where('hidden_status', false)->get();

        $q = $title. ", ". $category;
        if(count($posts) > 0)
            return view('layouts.user.explore')->withQuery($q)->withDetails($posts);
            // return view('layouts.user.explore', ['posts' => $posts])->withQuery($key)->withDetail($posts);
        
        // return view('layouts.user.explore')->withMessage('No posts found')->withQuery($q);
        return redirect()->action('ExplorePostsController@index')->withMessage('No posts found')->withQuery($q);
    }
}
