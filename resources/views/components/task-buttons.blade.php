<!-- Task Buttons Component -->
<div class="flex flex-col sm:flex-row gap-4 mb-6">
    <!-- Create Personal Task Button -->
    <a href="{{ route('tasks.create-personal') }}" 
       class="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 w-auto">
        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
        Create Personal Task
    </a>

    <!-- Assign Task Button -->
    <a href="{{ route('tasks.create-assigned') }}" 
       class="flex items-center justify-center bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 w-auto">
        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
        Assign Task
    </a>
</div>