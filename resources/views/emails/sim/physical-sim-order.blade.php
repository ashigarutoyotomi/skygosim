<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Physical sim card order</title>
</head>
<body>
<main>
    <h2>Hello {{ $user->first_name }} {{ $user->last_name }}</h2>
    <h2>We received your order</h2>

    <h4>Order status: {{ $order->status }}</h4>
</main>
</body>
</html>
