<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostsManagementController extends Controller
{
    public function index() {
        if(Gate::allows('isAdmin')){
        return view('layouts.admin.post-management');
        }
        else{
            return abort(404);
        }
    }
}
