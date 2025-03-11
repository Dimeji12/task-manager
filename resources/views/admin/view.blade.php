<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Tasks</title>
</head>
<body>
    <h1>{{ $user->name }}'s Tasks</h1>
    <ul>
        @foreach ($user->tasks as $task)
            <li>{{ $task->title }} - {{ $task->description }}</li>
        @endforeach
    </ul>
    <form action="{{ route('admin.user.assignTask', $user->id) }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task Title" required>
        <textarea name="description" placeholder="Task Description" required></textarea>
        <button type="submit">Assign Task</button>
    </form>
</body>
</html>