const filterDropdown = document.getElementById('filter');
const taskCards = document.querySelectorAll('.task-card');

filterDropdown.addEventListener('change', (event) =>
{
    const selectedFilter = event.target.value;

    taskCards.forEach(card =>
    {
        const cardStatus = card.getAttribute('data-status');

        if (selectedFilter === 'all' || cardStatus === selectedFilter)
        {
            card.style.display = 'block';
        } else
        {
            card.style.display = 'none';
        }
    });
});
