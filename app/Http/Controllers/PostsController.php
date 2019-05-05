<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Conner\Tagging\Taggable;
use DB;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        // $username = User::select('username')->where('id', Auth::user()->id)->get();
        // dd($posts);
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = 'Category';

        return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        return view('layouts.user.create-posts', ['categorys' => $categorys]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
        ]);
        
        // dd($request->all());

        $user = Auth::user();
        $post = new Post;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = rand() . '-' . $user->id . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $new_name);
            $post->post_cover = $new_name;
        }

        if ($request->hasFile('file')) {
            foreach($request->file('file') as $file) {
                $newfile_name = rand() . '-' . $user->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('files'), $newfile_name);
                $data[] = $newfile_name;  
                $post->files = json_encode($data);
            }
        }

        $tags = explode(",", $request->tags);
    
        $post->user_id = $user->id;
        $post->post_title = $request->input('title');
        $post->description = $request->input('description');
        $post->post_detail = $request->input('post_detail');
        $post->category = $request->input('category');
        $post->post_tag = $request->input('tags');
        $post->hidden_status = false;
        $post->report_status = false;
        $post->save();

        $post->tag($tags);

        return redirect()->action('PostsController@show', ['id' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $tags = $post->tags;
        $files = json_decode($post->files);
        $username = User::select('username')->where('id', $post->user_id)->get();

        return view('layouts.user.show-posts', ['post' => $post, 'tags' => $tags, 'files' => $files, 'username' => $username]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        return view('layouts.user.edit-posts' , ['post' => $post, 'categorys' => $categorys]);
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
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
        ]);
        // dd($request->all());
        $post = Post::findOrFail($id);
        // $post = Post::findOrFail($request->id);
        
        $user = Auth::user();

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $new_name = rand() . '-' . $user->id . '-' . $image->getClientOriginalName();
            $image->move(public_path('images'), $new_name);
            $post->post_cover = $new_name;
        }

        if ($request->hasFile('file')) {
            foreach($request->file('file') as $file) {
                $newfile_name = rand() . '-' . $user->id . '-' . $file->getClientOriginalName();
                $file->move(public_path('files'), $newfile_name);
                $data[] = $newfile_name;  
                $post->files = json_encode($data);
            }
        }

        $tags = explode(",", $request->tags);
        $post->untag();
    
        $post->post_title = $request->input('title');
        $post->description = $request->input('description');
        $post->post_detail = $request->input('post_detail');
        $post->category = $request->input('category');
        $post->post_tag = $request->input('tags');
        $post->save();

        $post->tag($tags);

        return redirect()->action('PostsController@show', ['id' => $post->id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->action('PostsController@index');
    }

    public function hidden($id)
    {
        $post = Post::findOrFail($id);

        if ($post->hidden_status == false)
            $post->hidden_status = true;
        else if ($post->hidden_status == true)
        $post->hidden_status = false;
        $post->save();
        return redirect()->action('PostsController@index');
    }

    public function report($id)
    {
        $post = Post::findOrFail($id);

        if ($post->report_status == false)
            $post->report_status = true;
        else if ($post->report_status == true)
        $post->report_status = false;
        $post->save();
        return redirect()->action('PostsController@index');
    }

    public function download($file_name) {

        $file_path = public_path('files/'.$file_name);
        return response()->download($file_path);
    }

    public function category($category) 
    {
        $posts = Post::where('category', $category)->get();
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];
        $dropdown = $category;

        return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function search(Request $request, $dropdown) 
    {
        $key = $request->input('title');
        $categorys = ['Lecture', 'Book', 'Apartment', 'Appliance', 'News', 'Sport', 'Other..'];

        if($dropdown == 'Category') {
            $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
            ->get();
        }
        else {
            $posts = Post::where('post_title', 'LIKE', '%'. $key . '%')
            ->where('category', $dropdown)
            ->get();
        }

        if(count($posts) > 0)
            return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($key)->withDetails($posts);
        
        return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($key);
    }

}
