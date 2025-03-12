@props(['task'])

<div class="task-card max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700" data-status="{{ $task->status }}">
    <!-- Task Name -->
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white break-words">
        {{ $task->name }}
    </h5>

    <!-- Task Description -->
    <div class="mb-3 font-normal text-gray-700 dark:text-gray-400 overflow-y-auto max-h-24 break-words">
        {{ $task->description }}
    </div>

    <!-- Task Status and Due Date -->
    <div class="flex items-center space-x-2 mb-4">
        <span class="
            inline-block px-3 py-1 rounded-full text-xs font-medium
            {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
            {{ $task->status === 'in-progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
        ">
            {{ strtoupper($task->status) }}
        </span>
        <span class="text-sm text-gray-500 dark:text-gray-400">
            Due: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y H:i') : 'No due date' }}
        </span>
    </div>

    <!-- Edit and Delete Buttons -->
    <div class="flex items-center space-x-2">
        <!-- Edit Button -->
        <a href="{{ route('tasks.edit', $task->id) }}" 
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Edit
        </a>

        <!-- Delete Button -->
        <x-delete-button :task="$task" />
    </div>
</div>