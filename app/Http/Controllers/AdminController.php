<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $users = User::where('is_admin', false)->get();
    return view('admin.dashboard', compact('users'));
}
}
