<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use ValidateRequests;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class ChangePasswordController extends Controller
{
    public function index() {
        if(Gate::allows('isAdmin')){
        return view('layouts.admin.change-password');
        }else{
            return redirect()->back();
        }
    }

    
    public function update(Request $request){
        if(Gate::allows('isAdmin')){
            $validatedData = $request->validate([
                'confirmPassword' => 'required',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required',
            ]);

            $email = Auth::user()->email;
            $result = DB::table('users')->select('*')->where('email',$email)->first();
                        
            
            
            if(Hash::check($request->input('currentPassword'),$result->password)){
                //check if newPassword and confirmNewPassword is matched
                if($request->input('newPassword') === $request->input('confirmPassword')){
                    DB::table('users')->where('email',$email)->update(['password'=>Hash::make($request->input('newPassword'))]);
                    return redirect()->back()->with('success','Your new password is changed!');
                }else{
                    //error that newPassword is not matched with confirmNewPassword
                    return redirect()->back()->with('error','Confirmed new password is not matched with new password!');
                    
                }
            }else{
                //error that current password is incorrect
                return redirect()->back()->with('error','Current password is incorrect');
            }
        }
        else{
            return abort(404);
        }              
    }
}
