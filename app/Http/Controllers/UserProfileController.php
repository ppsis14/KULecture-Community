<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\User;
use DB;
use App\UserProfile;

class UserProfileController extends Controller
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
        $profile = UserProfile::where('user_id', $id)->first();
        $this->authorize('update', $profile);
        return view('layouts.user.edit-profile', ['user' => $user, 'profile' => $profile]);
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
            'facebook' => 'nullable|string|required_with:facebook_username',
            'facebook_username' => 'nullable|string|required_with:facebook',
            'twitter' => 'nullable|string|required_with:twitter_username',
            'twitter_username' => 'nullable|string|required_with:twitter',
            'ig' => 'nullable|string|required_with:ig_username',
            'ig_username' => 'nullable|string|required_with:ig',
            'line' => 'nullable|string'
        ]);

        $user = User::findOrFail($id);
        $profile = UserProfile::where('user_id', $user->id)->first();
        $this->authorize('update', $profile);
        
        $user->profile()->update(
            [
                'bio' => $request->input('bio'),
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('ig'),
                'facebook_username' => $request->input('facebook_username'),
                'twitter_username' => $request->input('twitter_username'),
                'instagram_username' => $request->input('ig_username'),
                'line' => $request->input('line')
            ]
        );
        $user->username = $request->input('username');
        $user->save();
        

        return redirect()->action('UserProfileController@edit',  ['id' => $user->id])->with('success','Your information is updated successfully!');
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
}
