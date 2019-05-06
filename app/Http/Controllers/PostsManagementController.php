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
            ->where('hidden_status', false)
            ->orderBy('updated_at', 'desc')->paginate(10);
            return view('layouts.admin.post-management', ['post' => $post]);
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
            return redirect()->action('PostsManagementController@show', ['id' => $post->id])->with('success','Unreport complete');
        }
        else {
            return abort(404);
        }
    }
}
