<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use ValidatesRequests;
use DateTime;


class AddNewAdminController extends Controller
{
    public function index() {
        return view('layouts.admin.add-admin');
    }

    public function store(Request $req){
        $firstName = $req->input('firstName');
        $lastName = $req->input('lastName');
        $name = $firstName." ".$lastName;
        $email = $req->input('email');
        $password = Hash::make($req->input('password'));
        $confirmPassword = $req->input('confirmPassword');
        $role = "ADMINISTRATOR";
        $time = date('Y-m-d H:i:s');

        $validatedData = $req->validate([
            'firstName' => 'required|min:3|string',
            'lastName' => 'required|min:3|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if(Hash::check($confirmPassword,$password)){
            $data = array('username'=>$firstName, 'name'=>$name,'email'=>$email,'password'=>$password,
            'provider_id'=>"1111", 'role'=>$role,'created_at'=>$time );
            DB::table('users')->insert($data);
            $message = "Add admin in to system successfully.";
            // return redirect('/admin/addadmin')->with('jsAlert',$message);
            return redirect()->back()->with('success','New admin is added to system.');
            
        }
        else{
            return redirect()->back()->with('error','New password and confirm password are not matched.');
        }
        
    }
    

}
