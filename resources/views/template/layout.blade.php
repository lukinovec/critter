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
        @livewireStyles
    </head>
    <body class="w-full h-full">
        <div class="fixed top-0 z-40 flex justify-between w-full p-4 shadow-sm bg-gray-50">
            <a href="/" class="flex items-center justify-center h-8 space-x-1">
                <img class="w-8 h-full rounded-full" src="{{ url(asset('critter.png')) }}" alt="">
                <span class="text-xl font-extrabold">Critter</span>
            </a>
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
        @livewireScripts
        <script src="{{ url(asset('js/app.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="sweetalert2.all.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
        <script>
        window.addEventListener("swal:test", event => {
            async function test() {
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
                    Livewire.emit("upload-image", e.target.result)
                  }
                  reader.readAsDataURL(file)
                }
            }
            test();
        })
        </script>
    </body>
</html>
