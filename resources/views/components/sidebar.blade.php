<!-- Sidebar Toggler Button -->
<button id="sidebar-toggle" class="fixed top-4 left-4 z-50 p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
    </svg>
    <span class="sr-only">Toggle Sidebar</span>
</button>

<!-- Sidebar -->
<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-6 font-medium">
            <li>
                <span class="ms-3 text-lg font-semibold text-gray-900 dark:text-white">My Tasks</span>
            </li>

            <!-- Personal Tasks Link -->
            <li>
                <a href="#" id="personal-tasks-link" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <!-- Task List SVG Icon -->
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M15 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10Zm0 12V5H5v10h10Zm-8-8h6v2H7V7Zm0 4h6v2H7v-2Z"/>
                    </svg>
                    <span class="ms-3">Personal Tasks</span>
                </a>
                <!-- Personal Tasks Filter -->
                <div class="flex flex-col space-y-2 mt-2">
                    <div class="relative">
                        <select id="personal-task-filter" class="w-full mt-2 p-2 pl-3 pr-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none transition-all duration-200 ease-in-out hover:border-gray-400 dark:hover:border-gray-500">
                            <option value="all">All</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </li>

            <!-- Assigned Tasks Link -->
            <li>
                <a href="#" id="assigned-tasks-link" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <!-- Task List SVG Icon -->
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M15 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10Zm0 12V5H5v10h10Zm-8-8h6v2H7V7Zm0 4h6v2H7v-2Z"/>
                    </svg>
                    <span class="ms-3">Assigned Tasks</span>
                </a>
                <!-- Assigned Tasks Filter -->
                <div class="flex flex-col space-y-2 mt-2">
                    <div class="relative">
                        <select id="assigned-task-filter" class="w-full mt-2 p-2 pl-3 pr-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none transition-all duration-200 ease-in-out hover:border-gray-400 dark:hover:border-gray-500">
                            <option value="all">All</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                    <span class="ms-3">Profile</span>
                </a>
            </li>

            <!-- Log Out -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3"/>
                        </svg>
                        <span class="ms-3">Log Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</aside>

<!-- Overlay for Small Screens -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 sm:hidden hidden"></div>

<!-- JavaScript for Sidebar Toggling -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('default-sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        // Toggle Sidebar on Small Screens
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            // Hide the toggler button when the sidebar is open
            sidebarToggle.classList.toggle('hidden', !sidebar.classList.contains('-translate-x-full'));
        });

        // Close Sidebar When Clicking Outside on Small Screens
        sidebarOverlay.addEventListener('click', function () {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            // Show the toggler button when the sidebar is closed
            sidebarToggle.classList.remove('hidden');
        });

        // Close Sidebar When Resizing to Larger Screens
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 640) { // sm breakpoint
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                // Ensure the toggler button is hidden on larger screens
                sidebarToggle.classList.add('hidden');
            } else {
                // Ensure the toggler button is visible on smaller screens when the sidebar is closed
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebarToggle.classList.remove('hidden');
                }
            }
        });
    });
</script>