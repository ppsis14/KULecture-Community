<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\User;
use DB;
use Image;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.user.edit-profile');
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
        $profile = User::findOrFail($id);
        return view('layouts.user.home', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('layouts.user.edit-profile', ['user' => $user]);
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
        // validatation
        $this->validate($request, [
            'username' => 'required|distinct',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|numeric',
            'twitter' => 'nullable|string',
            'ig' => 'nullable|string',
            'line' => 'nullable|string'
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->input('username');
        $user->bio = $request->input('bio');
        $user->facebook = $request->input('facebook');
        $user->twitter = $request->input('twitter');
        $user->instagram = $request->input('ig');
        $user->line = $request->input('line');
        $user->save();

        return redirect()->action('UserProfileController@show',  ['id' => $user->id])->with('success','Update subject data successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uplaodAvatar(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time(). '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/'));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

        }
        return redirect()->action('UserProfileController@show',  ['user' => Auth::user()]);
       
    }
}
