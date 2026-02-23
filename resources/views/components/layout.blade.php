<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FOSS Timetable</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-white text-black px-4 md:px-12">
    <nav class="flex items-center justify-between py-4 border-b border-b-teal-600">
        <div>
            <a href="/">
                <h2 class="text-xl">FOSS TIMETABLE <span class="bg-amber-200 px-2 py-1 rounded-lg">DEMO</span></h2>
            </a>
        </div>
        <div class="space-x-6 font-bold">
            <x-nav-link href="/groups">Groups</x-nav-link>
            <x-nav-link href="/professors">Professors</x-nav-link>
            <x-nav-link href="/classrooms">Classrooms</x-nav-link>
        </div>
        @auth
            <div class="flex items-center gap-4">
                @if(Auth::user()->user_role === "prof")
                <a href="#">Send notification</a>
                @endif
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

{{--    <div id="mobile-menu"--}}
{{--         class="fixed inset-0 z-60 bg-slate-950 translate-x-full transition-transform duration-300 ease-in-out md:hidden">--}}
{{--        <div class="flex flex-col items-center justify-center h-full space-y-8">--}}
{{--            <button id="close-menu" class="absolute top-6 right-6 text-white text-3xl">--}}
{{--                &times;--}}
{{--            </button>--}}
{{--            <a href="#about" class="mobile-link text-3xl font-black uppercase text-white">About</a>--}}
{{--            <a href="#skills" class="mobile-link text-3xl font-black uppercase text-white">Skills</a>--}}
{{--            <a href="#projects" class="mobile-link text-3xl font-black uppercase text-white">Projects</a>--}}
{{--            <a href="#contact" class="mobile-link text-3xl font-black uppercase text-white">Contact</a>--}}
{{--            <a href="ro.html" class="mobile-link text-3xl font-black uppercase text-white"><img class="w-8"--}}
{{--                                                                                                src="./flags/ro.svg" alt="Romania flag"></a>--}}
{{--        </div>--}}
{{--    </div>--}}


    <section>
        {{$slot}}
    </section>

</body>
</html>
