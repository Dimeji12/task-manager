<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <ul>
    @if(isset($users) && $users->count() > 0)
        @foreach ($users as $user)
            <li>
                <a href="{{ route('admin.user.view', $user->id) }}">{{ $user->name }}</a>
            </li>
        @endforeach
    @else
        <li>No users found.</li>
    @endif
</ul>

</body>
</html>