<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;

class UserExplorePostsController extends Controller
{
    public function index() {

        if(Gate::allows('isUser')){
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')
            ->where('hidden_status', false)
            ->orderBy('created_at', 'desc')->paginate(10);

            $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
            $dropdown = 'All';
            
            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
        }
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function search(Request $request, $dropdown) 
    {
        if(Gate::allows('isUser')){
            $key = $request->input('key');
            $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

            if($dropdown == 'All') {
                $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.username')->where('hidden_status', false)
                ->where(function ($query) use ($key) {
                    $query->withAnyTag($key)
                    ->orWhere('post_title', 'LIKE', '%'. $key . '%');
                })->orderBy('created_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
            }
            else {
                $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.username')->where('hidden_status', false)
                ->where('category', $dropdown)
                ->where(function ($query) use ($key) {
                    $query->withAnyTag($key)
                    ->orWhere('post_title', 'LIKE', '%'. $key . '%');
                })->orderBy('created_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
            }


            if(count($posts) > 0)
                return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($key)->withDetails($posts);
            
            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($key);
        }
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function advance(Request $request) 
    {
        if(Gate::allows('isUser')){
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
                $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.username')->where('hidden_status', false)
                ->where('category', $category)
                ->where('post_title', 'LIKE', '%'. $title . '%')
                ->orderBy('created_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
                'tags' => $request->input('tags')]);
            }
            else {
                $tags = explode(",", $request->tags);
                $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.username')->where('hidden_status', false)
                ->where('category', $category)
                ->where('post_title', 'LIKE', '%'. $title . '%')
                ->withAnyTag($tags)
                ->orderBy('created_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
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
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function choose_category($category) 
    {
        if(Gate::allows('isUser')){
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('category', $category)
            ->where('hidden_status', false)->orderBy('created_at', 'desc')->paginate(10);
            $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
            $dropdown = $category;

            return view('layouts.user.explore', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
        }
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function tag($tag) 
    {
        if(Gate::allows('isUser')){
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->withAnyTag($tag)->where('hidden_status', false)->orderBy('created_at', 'desc')->paginate(10);
            $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

            return view('layouts.user.tag', ['categorys' => $categorys, 'tag' => $tag])->withDetails($posts);
        }
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function all_tag() 
    {
        if(Gate::allows('isUser')){
            $tags = Post::existingTags();
            $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

            return view('layouts.user.all-tags', ['categorys' => $categorys,'tags' => $tags]);
        }
        else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function __construct()
    {
      $this->middleware('auth');
    }
}
