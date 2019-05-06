<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class TagsController extends Controller
{
    public function index() 
    {
        $tags = Post::existingTags();
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        return view('layouts.user.all-tags', ['categorys' => $categorys,'tags' => $tags]);
    }

    public function show($tag) 
    {
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')->withAnyTag($tag)->where('hidden_status', false)->orderBy('updated_at', 'desc')->paginate(10);
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        return view('layouts.user.tag', ['categorys' => $categorys, 'tag' => $tag])->withDetails($posts);
    }

    public function advance(Request $request) 
    {
        $title = $request->input('post_title');
        $category = $request->input('category');
        $t = $request->input('tags');

        $key_title = '';
        $key_category = 'Category: ' . $category;
        $key_tags = '';

        if( $request->input('post_title') != null) {
            $key_title = 'Title: ' . $request->input('post_title');
            $key_category = ', Category: ' . $category;
        }

        if($request->input('tags') == null) {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('hidden_status', false)
            ->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->orderBy('updated_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags')]);
        }
        else {
            $tags = explode(",", $t);
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('hidden_status', false)
            ->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->withAnyTag($tags)
            ->orderBy('updated_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags')]);
            
            $key_tags = ', Tags: ' . $request->input('tags');
        }

        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
        $dropdown = $category;

        $q = $key_title . $key_category . $key_tags;

        if(count($posts) > 0)
            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($q)->withDetails($posts);
        
        return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($q);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
