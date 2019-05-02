<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminDashBoardController extends Controller
{
    public function showDashBoard(){
        return view('layouts.admin.dashboard');
    }

    public function delete($id) {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect('layouts.admin.dashboard');
    }
}
