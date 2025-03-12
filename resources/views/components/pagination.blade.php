@props(['tasks'])

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