<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Auth;
use UserProfile;

class HomeUsersController extends Controller
{
    public function index() {
        return view('layouts.user.home');
    }


    public function show($id)
    {
        $profile = UserProfile::findOrFail($id);
        return view('layouts.user.home', ['profile' => $profile]);
    }
}
