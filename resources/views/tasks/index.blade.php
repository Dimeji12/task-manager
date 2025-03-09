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
    @endif
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen">


<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">Product name</th>
            <th scope="col" class="px-6 py-3">Color</th>
            <th scope="col" class="px-6 py-3">Category</th>
            <th scope="col" class="px-6 py-3">Price</th>
            <th scope="col" class="px-6 py-3">Actions</th> <!-- Added Actions Column -->
        </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="py-3 px-4">{{ $task['id'] }}</td>
                <td class="py-3 px-4">{{ $task['name'] }}</td>
                <td class="py-3 px-4">
                    <span class="
                        inline-block px-3 py-1 rounded-full text-xs font-medium
                        {{ $task['status'] === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                        {{ $task['status'] === 'in-progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                        {{ $task['status'] === 'pending' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                    ">
                        {{ strtoupper($task['status']) }}
                    </span>
                </td>
                <td class="py-3 px-4">{{ $task['created_at'] }}</td>
                <td class="py-3 px-4">
                    <a href="{{ route('tasks.edit', $task['id']) }}" 
                       class="text-blue-600 hover:underline dark:text-blue-400">
                        Edit
                    </a>
                </td> 
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
