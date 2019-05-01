<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ExplorePostsController extends Controller
{
    public function index() {

        $posts = Post::where('hidden_status', true)->get();

        return view('layouts.user.explore')->withDetails($posts);
    }

    public function search(Request $request) {

        $key = $request->input('title');
        $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
        ->where('hidden_status', true)->get();

        if(count($posts) > 0)
            return view('layouts.user.explore')->withQuery($key)->withDetails($posts);
            // return view('layouts.user.explore', ['posts' => $posts])->withQuery($key)->withDetail($posts);
        
        return view('layouts.user.explore')->withMessage('No posts found')->withQuery($key);
    }

    public function advance(Request $request) {

        $title = $request->input('post_title');
        $tag = $request->input('post_tag');
        $posts = Post::where('post_title', 'LIKE', '%'. $title . '%')
        ->where('post_tag', 'LIKE', '%'. $tag . '%')
        ->where('hidden_status', true)->get();

        $q = $title. ", ". $tag;
        if(count($posts) > 0)
            return view('layouts.user.explore')->withQuery($q)->withDetails($posts);
            // return view('layouts.user.explore', ['posts' => $posts])->withQuery($key)->withDetail($posts);
        
        return view('layouts.user.explore')->withMessage('No posts found')->withQuery($key);
    }
}
=======
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ExplorePostsController extends Controller
{
    public function index() {

        $posts = Post::where('hidden_status', true)->get();

        return view('layouts.user.explore')->withDetails($posts);
    }

    public function search(Request $request) {

        $key = $request->input('title');
        $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
        ->where('hidden_status', true)->get();

        if(count($posts) > 0)
            return view('layouts.user.explore')->withQuery($key)->withDetails($posts);
            // return view('layouts.user.explore', ['posts' => $posts])->withQuery($key)->withDetail($posts);
        
        return view('layouts.user.explore')->withMessage('No posts found')->withQuery($key);
    }

    public function advance(Request $request) {

        $title = $request->input('post_title');
        $tag = $request->input('post_tag');
        $posts = Post::where('post_title', 'LIKE', '%'. $title . '%')
        ->where('post_tag', 'LIKE', '%'. $tag . '%')
        ->where('hidden_status', true)->get();

        $q = $title. ", ". $tag;
        if(count($posts) > 0)
            return view('layouts.user.explore')->withQuery($q)->withDetails($posts);
            // return view('layouts.user.explore', ['posts' => $posts])->withQuery($key)->withDetail($posts);
        
        return view('layouts.user.explore')->withMessage('No posts found')->withQuery($q);
    }
}
>>>>>>> 08742661ee61e2e95f5f69d499da22a0526c1500
