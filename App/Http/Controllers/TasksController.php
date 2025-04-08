<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        // Fetch personal tasks (created by the authenticated user)
        $personalTasks = Task::where('created_by', auth()->id())
            ->whereDoesntHave('users', function ($query) {
                $query->where('user_id', '!=', auth()->id());
            })
            ->when($request->has('personal_filter'), function ($query) use ($request) {
                $filter = $request->input('personal_filter');
                if ($filter !== 'all') {
                    $query->where('status', $filter);
                }
            })
            ->paginate(6); // 6 tasks per page
    
        // Fetch assigned tasks (assigned to the authenticated user but created by someone else)
        $assignedTasks = Task::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->where('created_by', '!=', auth()->id())
          ->when($request->has('assigned_filter'), function ($query) use ($request) {
              $filter = $request->input('assigned_filter');
              if ($filter !== 'all') {
                  $query->where('status', $filter);
              }
          })
          ->paginate(6); // 6 tasks per page
    
        return view('tasks.index', compact('personalTasks', 'assignedTasks'));
    }

    // Show the form for creating a personal task
    public function createPersonalTask()
    {
        return view('tasks.create-personal');
    }

    public function storePersonalTask(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'due_date' => 'nullable|date', // Make due_date optional
        ]);
    
        // Create the task and set the creator
        $task = Task::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'] ?? null, // Set due_date to null if not provided
            'status' => 'in-progress', // Default status
            'created_by' => auth()->id(), // Set the creator
        ]);
    
        // Attach the task to the authenticated user
        $task->users()->attach(auth()->id());
    
        return redirect()->route('tasks.index')->with('success', 'Personal task created successfully.');
    }

    // Show the form for assigning a task to other users
    public function createAssignedTask()
    {
        // Fetch all users except the authenticated user
        $users = User::where('id', '!=', auth()->id())->get();
        return view('tasks.create-assigned', compact('users'));
    }

   public function storeAssignedTask(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|min:3',
        'description' => 'nullable',
        'due_date' => 'nullable|date',
        'assigned_users' => 'required|array', // Ensure at least one user is selected
    ]);

    // Create the task
    $task = Task::create([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'due_date' => $validatedData['due_date'] ?? null,
        'status' => 'in-progress',
        'created_by' => auth()->id(),
    ]);

    // Attach the task to the selected users
    $task->users()->attach($validatedData['assigned_users']);

    return redirect()->route('tasks.index')->with('success', 'Task assigned successfully.');
}

    // Show the form for editing a personal task
    public function editPersonalTask(Task $task)
    {
        // Ensure the task is assigned to the authenticated user
        if (!$task->users->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit-personal', compact('task'));
    }

    // Update a personal task
    public function updatePersonalTask(Request $request, Task $task)
    {
        // Ensure the task is assigned to the authenticated user
        if (!$task->users->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'due_date' => 'required|date',
            'status' => 'required|in:in-progress,completed',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Personal task updated successfully.');
    }

    // Show the form for editing an assigned task
    public function editAssignedTask(Task $task)
    {
        // Ensure the task is assigned to the authenticated user
        if (!$task->users->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch all users except the authenticated user
        $users = User::where('id', '!=', auth()->id())->get();

        // Check if the authenticated user is the assigner or assignee
        $isAssigner = $task->created_by === auth()->id();

        return view('tasks.edit-assigned', compact('task', 'users', 'isAssigner'));
    }

    // Update an assigned task
    public function updateAssignedTask(Request $request, Task $task)
    {
        // Ensure the task is assigned to the authenticated user
        if (!$task->users->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the authenticated user is the assigner or assignee
        $isAssigner = $task->created_by === auth()->id();

        if ($isAssigner) {
            // Assigner can edit all fields
            $validatedData = $request->validate([
                'name' => 'required|min:3',
                'description' => 'nullable',
                'due_date' => 'required|date',
                'status' => 'required|in:in-progress,completed',
                'assigned_users' => 'required|array', // Array of user IDs
            ]);

            // Update the task
            $task->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'due_date' => $validatedData['due_date'],
                'status' => $validatedData['status'],
            ]);

            // Sync assigned users to the task
            $task->users()->sync($validatedData['assigned_users']);
        } else {
            // Assignee can only edit the status
            $validatedData = $request->validate([
                'status' => 'required|in:in-progress,completed',
            ]);

            $task->update([
                'status' => $validatedData['status'],
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        // Ensure the task is assigned to the authenticated user
        if (!$task->users->contains(auth()->id())) {
            abort(403, 'Unauthorized action.');
        }

        // Detach all users from the task before deleting
        $task->users()->detach();
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}