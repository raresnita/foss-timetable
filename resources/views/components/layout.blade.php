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
    <nav class="flex items-center justify-between py-4 border-b border-b-teal-600">
        <div>
            <a href="/">
                <h2 class="text-xl">FOSS TIMETABLE</h2>
            </a>
        </div>
        <div class="space-x-6 font-bold">
            <x-nav-link href="/groups">Groups</x-nav-link>
            <x-nav-link href="/professors">Professors</x-nav-link>
            <x-nav-link href="/classrooms">Classrooms</x-nav-link>
        </div>
        @auth
            <div class="flex items-center gap-4">
                <a href="#">Notifications</a>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="p-2 rounded-md text-red-500 hover:bg-red-500 hover:text-white">Log out</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="flex items-center gap-4">
                <a class="p-2 rounded-md hover:bg-teal-600 hover:text-white transition-colors duration-150" href="/register">Register</a>
                <a class="p-2 rounded-md hover:bg-teal-600 hover:text-white transition-colors duration-150" href="/login">Log in</a>
            </div>
        @endguest
    </nav>

    <div>
        {{$slot}}
    </div>
</div>

</body>
</html>
