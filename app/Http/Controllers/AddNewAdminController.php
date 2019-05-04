<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use ValidatesRequests;


class AddNewAdminController extends Controller
{
    public function index() {
        return view('layouts.admin.add-admin');
    }

    public function store(Request $req){

        $validatedData = $req->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $firstName = $req->input('firstName');
        $lastName = $req->input('lastName');
        $name = $firstName." ".$lastName;
        $email = $req->input('email');
        $password = Hash::make($req->input('password'));
        $confirmPassword = $req->input('confirmPassword');
        $role = "ADMINISTRATOR";
        if(Hash::check($confirmPassword,$password)){
            $data = array('username'=>$firstName, 'name'=>$name,'email'=>$email,'password'=>$password, 'provider_id'=>"1111");
            DB::table('users')->insert($data);
            $message = "Add admin in to system successfully.";
            // return redirect('/admin/addadmin')->with('jsAlert',$message);
            return redirect()->back()->with('success-message', 'Add new admin already!');
            
        }
        
    }
    // public function store(Request $request){
    //     $this->validate($request,[
    //         'firstName' => 'required',
    //         'lastName' => 'required',
    //         'password' => 'required',
    //         'confirmPassword' => 'required'
    //     ]);
    // }
}
