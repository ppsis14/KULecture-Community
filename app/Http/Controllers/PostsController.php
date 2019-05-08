<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Conner\Tagging\Taggable;
use DB;
use App\UserProfile;
use App\ReportComment;
use App\ReportPost;


class PostsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_all', Post::class);
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
        $dropdown = 'All';

        return view('layouts.user.posts',compact('posts'), ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
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
        $this->authorize('create', Post::class);

        $this->validate($request,[
            'title' => ['required', 'min:3'],
            'condition' => 'required|in:accept',
            'file.*' => 'mimes:doc,pdf,docx,png,jpeg,pptx,xlsx,csv,gif|max:20000'
        ]);
        
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
        $this->authorize('view', $post);
        $tags = $post->tags;
        $files = json_decode($post->files);
        $username = User::select('username')->where('id', $post->user_id)->get();
        $email = User::select('email')->where('id', $post->user_id)->get();
        $contact = UserProfile::where('user_id', $post->user_id)->first();
        $comments = ReportComment::where('post_id', $post->id)->get();
        $report_post = ReportPost::where('post_id', $post->id)->first();
        
        return view('layouts.user.show-posts', ['post' => $post, 'tags' => $tags, 'files' => $files, 'username' => $username, 'contact' => $contact, 'email' => $email, 
        'comments' => $comments, 'report_post' => $report_post]);
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
        $this->authorize('update', $post);
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
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
        $this->validate($request,[
            'title' => ['required', 'min:3'],
            'file.*' => 'mimes:doc,pdf,docx,png,jpeg,pptx,xlsx,csv,gif|max:20000'
        ]);

        $post = Post::findOrFail($id);
        $this->authorize('update', $post);

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

        return redirect()->action('PostsController@show', ['id' => $post->id])->with('success','The post had update!');
        
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
        $this->authorize('delete', $post);

        $post->delete();

        if(Auth::user()->isAdmin())
            return view('layouts.admin.post-management');

        return redirect()->action('PostsController@index')->with('success','The post had delete');
    }

    public function hidden($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('hide', $post);

        $post->hidden_status = true;
        $post->save();

        return redirect()->action('PostsController@show', ['id' => $post->id])->with('success','This post is hidden now.');;
    }

    public function unHidden($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('unHide', $post);

        $post->hidden_status = false;
        $post->save();
        return redirect()->action('PostsController@show', ['id' => $post->id])->with('success','This post is show now!');
    }

    public function report(Request $request, $id)
    {
        $this->validate($request,[
            'report-message' => 'required|min:3', 'min:3'
        ]);

        $post = Post::findOrFail($id);
        $user = Auth::user();

        $this->authorize('report', $post);

        $post->report_status = true;
        $post->save();

        $report_post = ReportPost::where('post_id', $post->id)->first();
        if($report_post == null) {
            $report_post = new ReportPost;
            $report_post->post_id = $post->id;
        }
        $report_post->report_admin = false;
        $report_post->report_user = false;
        $report_post->save();

        $comment = new ReportComment;
        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->detail = $request->input('report-message');
        $comment->save();
        return redirect()->action('PostsController@show', ['id' => $post->id])->with('success','Report complete');
    }

    public function report_to_admin($id)
    {
        if(Gate::allows('isUser')){
            $post = Post::findOrFail($id);
            $report_post = ReportPost::where('post_id', $post->id)->first();
            $report_post->report_admin = true;
            $report_post->save();

            return redirect()->action('PostsController@show', ['id' => $post->id])->with('success', 'The message had send to admin. Please wait for admin to check your post detail and unreport.');
        }
        else {
            return abort(404);
        }
    }

    public function download($file_name) {

        $file_path = public_path('files/'.$file_name);
        return response()->download($file_path);
    }

    public function choose_category($category) 
    {
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.username')->where('category', $category)->orderBy('created_at', 'desc')->paginate(10);
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
        $dropdown = $category;

        return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withDetails($posts);
    }

    public function search(Request $request, $dropdown) 
    {
        $key = $request->input('key');
        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];

        if($dropdown == 'All') {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('user_id', Auth::user()->id)
            ->where(function ($query) use ($key) {
                $query->withAnyTag($key)
                      ->orWhere('post_title', 'LIKE', '%'. $key . '%');
            })
            ->orderBy('created_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
        }
        else {
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('user_id', Auth::user()->id)
            ->where('category', $dropdown)
            ->where(function ($query) use ($key) {
                $query->withAnyTag($key)
                      ->orWhere('post_title', 'LIKE', '%'. $key . '%');
            })
            ->orderBy('created_at', 'desc')->paginate(10)->appends(['key' => $request->input('key'), 'dropdown' => $dropdown]);
        }

        

        if(count($posts) > 0)
            return view('layouts.user.posts',['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($key)->withDetails($posts);
        
        return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($key);
    }

    public function advance(Request $request, $id) 
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
            ->select('posts.*', 'users.username')->where('user_id', Auth::user()->id)
            ->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->orderBy('created', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags'), 'id' => $id]);
        }
        else {
            $tags = explode(",", $t);
            $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')->where('user_id', Auth::user()->id)
            ->where('category', $category)
            ->where('post_title', 'LIKE', '%'. $title . '%')
            ->withAnyTag($tags)
            ->orderBy('created_at', 'desc')->paginate(10)->appends(['post_title' => $request->input('post_title'), 'category' => $request->input('category'),
            'tags' => $request->input('tags'), 'id' => $id]);
            
            $key_tags = ', Tags: ' . $request->input('tags');
        }

        $categorys = ['Books', 'Lectures', 'Domitory', 'Electronics', 'News', 'Sports', 'Others'];
        $dropdown = $category;

        $q = $key_title . $key_category . $key_tags;

        if(count($posts) > 0)
            return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withQuery($q)->withDetails($posts);
        
        return view('layouts.user.posts', ['categorys' => $categorys, 'dropdown' => $dropdown])->withMessage('No posts found')->withQuery($q);
    }

    

}
