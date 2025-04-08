document.addEventListener('DOMContentLoaded', function ()
{
    const searchInput = document.getElementById('search');
    const taskCards = document.querySelectorAll('.task-card');
    const filterStateBox = document.getElementById('filter-state-box');

    // Sidebar Links
    const allTasksLink = document.getElementById('all-tasks');
    const completedTasksLink = document.getElementById('completed-tasks');
    const inProgressTasksLink = document.getElementById('in-progress-tasks');

    let currentFilter = 'all';

    if (searchInput && taskCards.length > 0 && filterStateBox)
    {
        // Search Functionality
        searchInput.addEventListener('input', () =>
        {
            filterTasks();
        });

        // Sidebar Filter Functionality
        allTasksLink.addEventListener('click', (event) =>
        {
            event.preventDefault();
            currentFilter = 'all';
            updateFilterStateBox('All Tasks');
            filterTasks();
        });

        completedTasksLink.addEventListener('click', (event) =>
        {
            event.preventDefault();
            currentFilter = 'completed';
            updateFilterStateBox('Completed Tasks');
            filterTasks();
        });

        inProgressTasksLink.addEventListener('click', (event) =>
        {
            event.preventDefault();
            currentFilter = 'in-progress';
            updateFilterStateBox('In Progress Tasks');
            filterTasks();
        });

        // Combined Filter and Search Function
        function filterTasks()
        {
            const searchQuery = searchInput.value.trim().toLowerCase();

            taskCards.forEach(card =>
            {
                const taskName = card.querySelector('h5').textContent.toLowerCase();
                const taskStatus = card.getAttribute('data-status');

                const matchesSearch = taskName.includes(searchQuery);
                const matchesFilter = currentFilter === 'all' || taskStatus === currentFilter;

                if (matchesSearch && matchesFilter)
                {
                    card.style.display = 'block';
                } else
                {
                    card.style.display = 'none';
                }
            });
        }

        // Update Filter State Box
        function updateFilterStateBox(filterText)
        {
            filterStateBox.textContent = filterText;
        }
    }
});