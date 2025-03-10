<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TasksController extends Controller
{

     
    public function index()
{

// Paginate the tasks 

// this  Paginates the tasks 

    $tasks = Task::where('user_id', auth()->id())->paginate(10);

    return view('tasks.index', compact('tasks'));
}


//Show the form for creating a new resource.

//shows the form for creating a new resource.

   
    public function create()
    {
        return view('tasks.create');
    }


//Store a newly created resource in storage.

//Store a newly created task in database.


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'due_date' => 'nullable|date', 
           
        ]);

        Auth::user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    
    public function edit(Task $task)
    {

// Check if the authenticated user owns the task

// Checks if the authenticated user owns the task he wants to update

        if (Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('task'));
    }

    

// Update the specified resource in storage.

// This Updates the specified task in the data base after confirming the task belongs 
// to the user .

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
             'due_date' => 'nullable|date', 
         ]);
     
         $task->update($request->all());
     
         return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
     }

    public function destroy(Task $task)
{
    // Check if the authenticated user owns the task
    if (Auth::id() !== $task->user_id) {
        abort(403, 'Unauthorized action.');
    }

    // Delete the task
    $task->delete();

    // Redirect to the task list with a success message
    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
}
}