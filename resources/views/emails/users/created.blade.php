<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to SkyGo</title>

    <style>
        .container {
            max-width: 500px;
            margin: auto;
            font-family: Roboto, 'sans-serif';
        }

        .logo {
            height: 40px;
        }

        .text-center {
            text-align: center;
        }

        h2 {
            margin: 1rem 0 1.2rem 0;
        }

        h3 {
            font-weight: normal;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <img class="logo" src="{{config('app.url')}}/images/skygo_logo.png" alt="SkyGo">

            <h2 class="text-center">
                Your account created!
            </h2>

            <h3>Hello {{$user->first_name}} {{$user->last_name}},</h3>
            <h3>Thank you for using SkyGo,</h3>

            <br>

            <h3>Account info:</h3>

            <h3>Your login: {{ $user->email }}</h3>
            <h3>Your password: {{ $user->password }}</h3>
        </div>
    </main>
</body>
</html>
