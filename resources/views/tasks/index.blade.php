<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/js/taskFilter.js'])
    @endif
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
    <!-- Sidebar Toggle Button (Visible on Small Screens) -->
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="fixed top-4 left-4 z-50 p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <span class="ms-3">My Tasks</span>
                </li>
                <li>
                    <!-- Create Task Button -->
                    <div class="mb-6">
                        <a href="{{ route('tasks.create') }}" 
                           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            Create Task
                        </a>
                    </div>
                </li>
                <!-- All Tasks -->
                <li>
                    <a href="#" id="all-tasks" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3">All Tasks</span>
                    </a>
                </li>
                <!-- Completed Tasks -->
                <li>
                    <a href="#" id="completed-tasks" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                        </svg>
                        <span class="ms-3">Completed Tasks</span>
                    </a>
                </li>
                <!-- In Progress Tasks -->
                <li>
                    <a href="#" id="in-progress-tasks" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h1"/>
                        </svg>
                        <span class="ms-3">In Progress Tasks</span>
                    </a>
                </li>
                <li>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
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
                <!-- Image -->
                <img src="{{ asset('images/task2.jpg') }}" alt="No Tasks" class="w-64 h-64 mb-4">

                <!-- Message -->
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
                    You currently have no tasks. Click the button below to create one!
                </p>

                <!-- Create Task Button -->
                <a href="{{ route('tasks.create') }}" 
                   class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                    Create Task
                </a>
            </div>
        @else
            <!-- Display Tasks -->
            <div id="task-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tasks as $task)
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
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($tasks->hasPages())
                <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-6" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                        Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $tasks->firstItem() }}</span> to 
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $tasks->lastItem() }}</span> of 
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $tasks->total() }}</span>
                    </span>
                    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                        <!-- Previous Page Link -->
                        @if ($tasks->onFirstPage())
                            <li>
                                <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                                    Previous
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $tasks->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Previous
                                </a>
                            </li>
                        @endif

                        <!-- Pagination Elements -->
                        @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $tasks->currentPage() === $page ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($tasks->hasMorePages())
                            <li>
                                <a href="{{ $tasks->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Next
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                                    Next
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @endif
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>