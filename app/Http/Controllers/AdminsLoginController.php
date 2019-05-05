<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminsLoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    
    public function index(){
        if(Gate::allows('isAdmin')){
        return view('layouts.admin.admin-login');
        }
        else{
            return abort(404);
        }
    }

}

