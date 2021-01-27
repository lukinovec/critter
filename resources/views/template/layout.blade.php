<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="icon" href="{{ url(asset('/critter.png')) }}" type="image/x-icon"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            [x-cloak] { display: none; }
        </style>
        <title>Critter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="w-full h-full">
        <div class="fixed top-0 flex justify-end w-full h-full p-4">
            <ul class="flex flex-col mt-4 space-x-6 space-y-2 text-xs sm:space-y-0 sm:mt-0 sm:flex-row sm:text-base">
                @if (Auth::check())
                <li>
                    <a href="/user/{{ Auth::id() }}">
                        Your profile
                    </a>
                </li>
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
        <script src="{{ url(asset('js/app.js')) }}"></script>
    </body>
</html>
