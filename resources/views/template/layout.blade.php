<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="icon" href="{{ url(asset('/critter.png')) }}" type="image/x-icon"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Critter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="fixed top-0 flex justify-end w-full p-6">
            <ul class="flex space-x-6">
                @if (Auth::check())
                <li>
                    <a href="/logout">
                        Log out
                    </a>
                </li>
                @else
                <li>
                    <a href="/login">
                        Log in
                    </a>
                </li>
                <li>
                    <a href="/register">
                        Register
                    </a>
                </li>
                @endif
            </ul>
        </div>
        @yield('content')
    </body>
</html>
