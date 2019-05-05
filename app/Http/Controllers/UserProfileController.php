<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\User;
use DB;
use App\UserProfile;

class UserProfileController extends Controller
{
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
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'ig' => 'nullable|string',
            'line' => 'nullable|string'
        ]);

        $user = User::findOrFail($id);
        
        $user->profile()->update(
            [
                'bio' => $request->input('bio'),
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('ig'),
                'line' => $request->input('line')
            ]
        );
        $user->username = $request->input('username');
        $user->save();
        

        return redirect()->action('UserProfileController@edit',  ['id' => $user->id])->with('success','Update subject data successfully!');
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
