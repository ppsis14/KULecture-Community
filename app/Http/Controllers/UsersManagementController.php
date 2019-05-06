<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;

class UsersManagementController extends Controller
{
    public function index() {
        if(Gate::allows('isAdmin')){
            $users = User::where('role', 'USER')->get();
            $admins = User::where('role', 'ADMINISTRATOR')->get();
            return view('layouts.admin.user-management', ['users' => $users, 'admins' => $admins]);
        }else{
            return abort(404);
        }
    }

    public function destroy($id) {
        if(Gate::allows('isAdmin')){
            $user = User::findORFail($id);
            $user->delete();
            return redirect()->action('UsersManagementController@index');
        }else{
            return abort(404);
        }   
    }
}
