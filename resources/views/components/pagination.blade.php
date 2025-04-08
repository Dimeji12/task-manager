<!-- Pagination Component -->
@props(['personalTasks', 'assignedTasks'])

@if ($personalTasks->hasPages() || $assignedTasks->hasPages())
    <div class="mt-8">
        {{ $personalTasks->links() }}
        {{ $assignedTasks->links() }}
    </div>
@endif