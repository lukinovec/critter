<!DOCTYPE html>
<html x-data="{ dark: false }" :class="{ 'dark': dark }" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        @livewireStyles
    </head>
    <body class="w-full h-full dark:text-gray-200 dark:bg-gray-800">
        <div class="fixed top-0 z-40 flex items-center justify-between w-full px-4 shadow-sm bg-gray-50 dark:bg-gray-900">
            <a href="/" class="flex items-center justify-center h-8 space-x-1">
                <img class="w-8 h-full rounded-full" src="{{ url(asset('critter.png')) }}" alt="Home">
                <span class="hidden text-xl font-extrabold sm:block">Critter</span>
            </a>
            @auth
            <livewire:user-search />
            @endauth
            <ul class="flex flex-wrap items-center justify-end space-x-3 text-xs text-center sm:space-y-0 sm:text-base">
                @auth
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
                @endauth
                <li class="flex items-center justify-between px-8 py-6 space-x-2">
                    <h1>Dark mode</h1>
                    <div x-on:click="dark = !dark" class="flex-shrink-0 w-16 h-10 p-1 bg-gray-300 rounded-full">
                       <div class="flex items-center justify-center w-8 h-8 duration-300 ease-in-out transform bg-white rounded-full shadow-md" :class="{'translate-x-6': dark}">
                            <span class="p-1 text-xs text-gray-600 select-none" x-text="dark ? 'On' : 'Off'"></span>
                        </div>
                    </div>
                </li>
                @guest
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
                @endguest
            </ul>
        </div>
        @yield('content')
        @livewireScripts
        <script src="{{ url(asset('js/app.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="sweetalert2.all.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
        <script>
        async function uploadImage(parent) {
            const { value: file } = await Swal.fire({
              title: 'Select image (JPG or PNG)',
              input: 'file',
              inputAttributes: {
                'accept': 'image/*',
                'aria-label': 'Upload your profile picture'
              }
            })
            if (file) {
              const reader = new FileReader()
              reader.onload = (e) => {
                Swal.fire({
                  title: 'Your uploaded picture',
                  imageUrl: e.target.result,
                  imageAlt: 'The uploaded picture'
                })
                Livewire.emit('upload-image', {image: e.target.result, parent: parent})
              }
              reader.readAsDataURL(file)
            }
        }

        window.addEventListener("swal:upload-image", event => {
            uploadImage(event.detail.parent);
        })
        </script>
    </body>
</html>
