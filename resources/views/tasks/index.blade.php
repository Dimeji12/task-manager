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

  
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">

    <!-- Side bar -->
    <x-sidebar />
   

    <!--This is the welcome message section  -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 py-4 text-center flex flex-row items-center justify-center space-x-4 sm:ml-64">
    <img src="{{ asset('images/chrysalis.png') }}" alt="Logo" class="w-12 h-12">
    <div class="text-left">
        <h1 class="text-2xl sm:text-4xl font-bold text-white animate-bounce">
            Welcome, {{ Auth::user()->name }}!
        </h1>
        <p class="mt-1 text-sm sm:text-lg text-white opacity-90">
            We're glad to have you here. Let's get things done!
        </p>
    </div>
</div>
    

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <!-- Search Bar -->
            <div class="flex-grow">
                <input type="text" id="search" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search tasks...">
            </div>

            <!-- Task Filter State Box which displays the current state of the filter option selected -->
            <div id="filter-state-box" class="p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                All Tasks  
            </div>
        </div>

        
            
           
            <!-- Create Task Button -->
<div class="mb-6 flex justify-left">
    <a href="{{ route('tasks.create') }}" 
       class="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition  duration-200 w-auto">
        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
        Create Task
    </a>
</div>
        <!-- Task Cards Grid -->
         <!-- An if statement to check if the task list is empty and if it is display an image and a message 
          else display the tasks created  -->
        @if ($tasks->isEmpty())
            <div class="flex flex-col items-center justify-center h-screen -mt-20">
                <img src="{{ asset('images/task2.jpg') }}" alt="No Tasks" class="w-63 h-60 mb-4">
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
                    You currently have no tasks. Click the create task button above to create one!
                </p>
                <!-- Create Task Button -->
                <!-- <a href="{{ route('tasks.create') }}" 
                   class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                    Create Task
                </a> -->
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




<!-- This is a delete button which is embedded in the card to delete a task Delete and also triggers
 a modal when clicked to confirm deletion -->
<!-- Delete Button (Triggers Modal) -->
<button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg 
    hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 
    dark:focus:ring-red-800">
    Delete
</button>

<form id="delete-form" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
<!-- Delete Confirmation Modal -->
<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 
    z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Close Button -->
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center 
                dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <!-- Modal Content -->
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" 
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    Are you sure you want to delete this task?
                </h3>
                <!-- Confirm Delete Button -->
                <button id="confirm-delete" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none 
                        focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm 
                        inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <!-- Cancel Button -->
                <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white 
                        rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 
                        focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 
                        dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    No, cancel
                </button>
            </div>
        </div>
    </div>
</div>
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
    
  <!-- JavaScript to Handle Modal Submission -->
  <script>
    document.getElementById('confirm-delete').addEventListener('click', function () {
        document.getElementById('delete-form').submit();
    });
</script>
    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>