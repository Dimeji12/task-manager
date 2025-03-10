// resources/js/taskFilter.js
document.addEventListener('DOMContentLoaded', function ()
{
    const searchInput = document.getElementById('search');
    const filterDropdown = document.getElementById('filter');
    const taskCards = document.querySelectorAll('.task-card');

    if (searchInput && filterDropdown && taskCards.length > 0)
    {
        // Search Functionality
        searchInput.addEventListener('input', (event) =>
        {
            filterTasks();
        });

        // Filter Functionality
        filterDropdown.addEventListener('change', (event) =>
        {
            filterTasks();
        });

        // Combined Filter and Search Function
        function filterTasks()
        {
            const searchQuery = searchInput.value.trim().toLowerCase();
            const selectedFilter = filterDropdown.value;

            taskCards.forEach(card =>
            {
                const taskName = card.querySelector('h5').textContent.toLowerCase();
                const taskStatus = card.getAttribute('data-status');

                const matchesSearch = taskName.includes(searchQuery);
                const matchesFilter = selectedFilter === 'all' || taskStatus === selectedFilter;

                if (matchesSearch && matchesFilter)
                {
                    card.style.display = 'block'; // Show the card
                } else
                {
                    card.style.display = 'none'; // Hide the card
                }
            });
        }
    }
});