<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/js/taskFilter.js'])
    @endif
  <!-- Tom Select CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Header -->
    <x-header />

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <!-- Task Buttons -->
        <x-task-buttons />

        <!-- Search and Filter -->
        <x-search-filter />

        <!-- Personal Tasks Section -->
        <div id="personal-tasks-section">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Personal Tasks</h2>
            <!-- <select id="personal-task-filter" class="mb-4">
                <option value="all">All</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
            </select> -->
            <div id="personal-task-grid">
                <x-task-list :tasks="$personalTasks" type="personal" />
            </div>
            <!-- Pagination for Personal Tasks -->
            @if ($personalTasks->hasPages())
                <div class="mt-8" id="personal-pagination">
                    {{ $personalTasks->links() }}
                </div>
            @endif
        </div>

        <!-- Assigned Tasks Section -->
        <div id="assigned-tasks-section" class="hidden">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Assigned Tasks</h2>
            <!-- <select id="assigned-task-filter" class="mb-4">
                <option value="all">All</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
            </select> -->
            <div id="assigned-task-grid">
                <x-task-list :tasks="$assignedTasks" type="assigned" />
            </div>
            <!-- Pagination for Assigned Tasks -->
            @if ($assignedTasks->hasPages())
                <div class="mt-8" id="assigned-pagination">
                    {{ $assignedTasks->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <x-delete-modal />

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const personalTasksLink = document.getElementById('personal-tasks-link');
            const assignedTasksLink = document.getElementById('assigned-tasks-link');
            const personalTasksSection = document.getElementById('personal-tasks-section');
            const assignedTasksSection = document.getElementById('assigned-tasks-section');

            personalTasksLink.addEventListener('click', function (e) {
                e.preventDefault();
                personalTasksSection.classList.remove('hidden');
                assignedTasksSection.classList.add('hidden');
            });

            assignedTasksLink.addEventListener('click', function (e) {
                e.preventDefault();
                personalTasksSection.classList.add('hidden');
                assignedTasksSection.classList.remove('hidden');
            });

            // Filter Personal Tasks
            const personalTaskFilter = document.getElementById('personal-task-filter');
            personalTaskFilter.addEventListener('change', function () {
                fetchFilteredTasks('personal', this.value);
            });

            // Filter Assigned Tasks
            const assignedTaskFilter = document.getElementById('assigned-task-filter');
            assignedTaskFilter.addEventListener('change', function () {
                fetchFilteredTasks('assigned', this.value);
            });

            // Fetch Filtered Tasks via AJAX
            function fetchFilteredTasks(type, filter) {
                const url = new URL(window.location.href);
                url.searchParams.set(`${type}_filter`, filter);

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Update the task grid and pagination
                    if (type === 'personal') {
                        document.getElementById('personal-task-grid').innerHTML =
                            doc.getElementById('personal-task-grid').innerHTML;
                        document.getElementById('personal-pagination').innerHTML =
                            doc.getElementById('personal-pagination')?.innerHTML || '';
                    } else {
                        document.getElementById('assigned-task-grid').innerHTML =
                            doc.getElementById('assigned-task-grid').innerHTML;
                        document.getElementById('assigned-pagination').innerHTML =
                            doc.getElementById('assigned-pagination')?.innerHTML || '';
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-task-btn');
    const deleteForm = document.getElementById('delete-form');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const taskId = this.getAttribute('data-task-id');
            const taskType = this.getAttribute('data-task-type');
            const actionUrl = `/tasks/${taskId}`; // Adjust the URL as needed

            deleteForm.setAttribute('action', actionUrl);
        });
    });
});
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</body>
</html>