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

public function viewUser($id)
{
    $user = User::with('tasks')->findOrFail($id);
    return view('admin.user.view', compact('user'));
}

public function assignTask(Request $request, $id)
{
    $user = User::findOrFail($id);

    $task = new Task([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'user_id' => $user->id,
    ]);

    $task->save();

    return redirect()->back()->with('success', 'Task assigned successfully.');
}
}
