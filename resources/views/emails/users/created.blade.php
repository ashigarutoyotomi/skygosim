<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Created</title>
</head>
<body>
    <main>
        <h2>Hello {{ $user->first_name }} {{ $user->last_name }}</h2>
        <h2>Welcome to SkyGo</h2>

        <h4>Your login: {{ $user->email }}</h4>
        <h4>Your password: {{ $user->password }}</h4>
    </main>
</body>
</html>
