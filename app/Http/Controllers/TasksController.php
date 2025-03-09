<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
        ]);

        Auth::user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
  /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Check if the authenticated user owns the task
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Check if the authenticated user owns the task
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'status' => 'required|in:in-progress,completed',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}