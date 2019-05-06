<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\User;
use App\UserProfile;

class PostsManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isAdmin')){
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')
            ->orderBy('updated_at', 'desc')->get();
            return view('layouts.admin.post-management', ['posts' => $posts]);
        }
        else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::allows('isAdmin')){
            $post = Post::findOrFail($id);
            // $this->authorize('view', $post);
            $tags = $post->tags;
            $files = json_decode($post->files);
            $username = User::select('username')->where('id', $post->user_id)->get();
            $email = User::select('email')->where('id', $post->user_id)->get();
            $contact = UserProfile::where('user_id', $post->user_id)->first();

            return view('layouts.admin.show-posts', ['post' => $post, 'tags' => $tags, 'files' => $files, 'username' => $username, 'contact' => $contact, 'email' => $email]);
        }
        else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('isAdmin')){
            $post = Post::findOrFail($id);
            $post->delete();

            return redirect()->action('PostsManagementController@index')->with('success','The post had delete');
        }
        else {
            return abort(404);
        }
    }

    public function hidden($id)
    {
        if(Gate::allows('isAdmin')){
            $post = Post::findOrFail($id);
            $post->hidden_status = true;
            $post->save();

            return redirect()->action('PostsManagementController@show', ['id' => $post->id])->with('success','This post is hidden now.');
        }
        else {
            return abort(404);
        }
    }

    public function unHidden($id)
    {
        if(Gate::allows('isAdmin')){
            $post = Post::findOrFail($id);
            $post->hidden_status = false;
            $post->save();

            return redirect()->action('PostsManagementController@show', ['id' => $post->id])->with('success','This post is show now!');
        }
        else {
            return abort(404);
        }
    }

    public function unReport($id)
    {
        if(Gate::allows('isAdmin')){
            $post = Post::findOrFail($id);
            $post->report_status = false;

        $post->save();
        return redirect()->action('PostsManagementController@show', ['id' => $post->id])->with('success','Unreport this post complete');
    }
        else {
            return abort(404);
        }
    }

    public function tag($tag) 
    {
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')->withAnyTag($tag)->orderBy('updated_at', 'desc')->paginate(10);
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        return view('layouts.admin.tag', ['categorys' => $categorys, 'tag' => $tag])->withDetails($posts);
    }

    public function all_tag() 
    {
        $tags = Post::existingTags();
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        return view('layouts.admin.all-tags', ['categorys' => $categorys,'tags' => $tags]);
    }

    public function category($category) 
    {
        if($category != 'All') {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('category', $category)->orderBy('updated_at', 'desc')->paginate(10);
        }
        else {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')
            ->orderBy('updated_at', 'desc')->paginate(10);
        }

        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
        $dropdown = $category;
        return view('layouts.admin.category', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function search(Request $request, $dropdown) 
    {
        $key = $request->input('key');
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        if($dropdown == 'All') {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where(function ($query) use ($key) {
                $query->withAnyTag($key)
                ->orWhere('post_title', 'LIKE', '%'. $key . '%');
            })->orderBy('updated_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
        }
        else {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('category', $dropdown)
            ->where(function ($query) use ($key) {
                $query->withAnyTag($key)
                ->orWhere('post_title', 'LIKE', '%'. $key . '%');
            })->orderBy('updated_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
        }


        if(count($posts) > 0)
            return view('layouts.admin.category', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($key)->withDetails($posts);
        
        return view('layouts.admin.category', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($key);
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
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->orderBy('updated_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags')]);
        }
        else {
            $tags = explode(",", $request->tags);
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('category', $category)
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
            return view('layouts.admin.category', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($q)->withDetails($posts);
        
        return view('layouts.admin.category', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($q);
    }

}
