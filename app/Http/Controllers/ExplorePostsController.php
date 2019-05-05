<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class ExplorePostsController extends Controller
{
    public function index() {
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')
        ->where('hidden_status', false)
        ->orderBy('updated_at', 'desc')->paginate(10);

        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = 'All';
        
        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function search(Request $request, $dropdown) 
    {
        $key = $request->input('key');
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];

        if($dropdown == 'All') {
            $posts = Post::where('hidden_status', false)
            ->where(function ($query) use ($key) {
                $query->withAnyTag($key)
                ->orWhere('post_title', 'LIKE', '%'. $key . '%');
            })->orderBy('updated_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
        }
        else {
            $posts = Post::where('hidden_status', false)
            ->where('category', $dropdown)
            ->where(function ($query) use ($key) {
                $query->withAnyTag($key)
                ->orWhere('post_title', 'LIKE', '%'. $key . '%');
            })->orderBy('updated_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
        }


        if(count($posts) > 0)
            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($key)->withDetails($posts);
        
        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($key);
    }

    public function advance(Request $request) 
    {
        $title = $request->input('post_title');
        $category = $request->input('category');

        $key_title = '';
        $key_category = 'Category: ' . $category;
        $key_tags = '';

        if( $request->input('post_title') != null) {
            $key_title = 'Title: ' . $request->input('post_title');
            $key_category = ', Category: ' . $category;
        }

        if($request->input('tags') == null) {
            $posts = Post::where('hidden_status', false)
            ->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->orderBy('updated_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags')]);
        }
        else {
            $tags = explode(",", $request->tags);
            $posts = Post::where('hidden_status', false)
            ->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->withAnyTag($tags)
            ->orderBy('updated_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags')]);
            
            $key_tags = ', Tags: ' . $request->input('tags');
        }

        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = $category;

        $q = $key_title . $key_category . $key_tags;

        if(count($posts) > 0)
            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($q)->withDetails($posts);
        
        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($q);
    }

    public function category($category) 
    {
        $posts = Post::where('category', $category)
        ->where('hidden_status', false)->orderBy('updated_at', 'desc')->paginate(10);
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = $category;

        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
