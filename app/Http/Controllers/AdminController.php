<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    // Display the admin dashboard with a list of users

    public function index()
    {
        // $users = User::where('role_id', 2)->get(); // Fetch all regular users (role_id = 2)
        // return view('admin.dashboard', compact('users'));
        $users = User::all(); // Fetch users from the database
        return view('dashboard', compact('users'));
    }

    // Display a specific user's tasks
    public function viewUserTasks($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user_tasks', compact('user'));
    }

    // Assign a task to a specific user
    public function assignTask(Request $request, $userId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $user = User::findOrFail($userId);
        $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.user.view', $userId)->with('success', 'Task assigned successfully.');
    }
}