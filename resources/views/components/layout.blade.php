<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timetable</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black">
    <div class="px-12">
        <nav class="flex items-center justify-between py-4 border-b border-b-blue-500">
            <div>
                <a href="/">
                    <h2 class="text-xl">FOSS TIMETABLE</h2>
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <x-nav-link href="#" >Groups</x-nav-link>
                <x-nav-link href="#">Professors</x-nav-link>
                <x-nav-link href="#">Classrooms</x-nav-link>
            </div>
            @auth
                <div>
                    <a href="#">Notifications</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button>Log out</button>
                    </form>
                </div>
            @endauth

            @guest
                <div>
                    <a href="/register">Register</a>
                    <a href="/login">Log in</a>
                </div>
            @endguest
        </nav>

        <div>
            {{$slot}}
        </div>
    </div>

</body>
</html>
