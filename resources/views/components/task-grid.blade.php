<div>
    <!-- Search and Filter Section -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <!-- Search Bar -->
        <div class="flex-grow">
            <input type="text" id="search" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search tasks...">
        </div>

        <!-- Filter State Box -->
        <div id="filter-state-box" class="p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            All Tasks
        </div>
    </div>

    <!-- Task Cards Grid -->
    @if ($tasks->isEmpty())
        <!-- No Tasks Found -->
        <div class="flex flex-col items-center justify-center h-screen -mt-20">
            <img src="{{ asset('images/task2.jpg') }}" alt="No Tasks" class="w-63 h-60 mb-4">
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
                You currently have no tasks. Click the button below to create one!
            </p>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                Create Task
            </a>
        </div>
    @else
        <!-- Display Tasks -->
        <div id="task-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($tasks as $task)
                <x-task-card :task="$task" />
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($tasks->hasPages())
            <x-pagination :tasks="$tasks" />
        @endif
    @endif
</div>