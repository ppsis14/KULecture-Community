<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use ValidateRequests;

class ChangePasswordController extends Controller
{
    public function index() {
        return view('layouts.admin.change-password');
    }
    public function update(Request $request){
        if(Auth::check()){
            $email = Auth::user()->email;
            $result = DB::table('users')->select('*')->where('email',$email)->first();
            if(Hash::check($request->input('currentPassword'),$result->password)){
                //check if newPassword and confirmNewPassword is matched
                if($request->input('newPassword') === $request->input('confirmPassword')){
                    DB::table('users')->where('email'=== $email)->update(['password'=>Hash::make($request->input('newPassword'))]);
                }else{
                    //error that newPassword is not matched with confirmNewPassword
                    
                }
            }else{
                //error that current password is incorrect
            }
        }
    }
}
