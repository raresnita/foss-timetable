<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FOSS Timetable</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-slate-50 text-slate-950 px-4 md:px-12 pb-8 dark:bg-slate-950 dark:text-slate-200">

    <nav x-data="{ mobileMenuOpen: false }" class="border-b border-b-indigo-600 dark:border-b-indigo-400">
        <div class="flex items-center justify-between py-4">
            <div>
                <a href="/">
                    <h2 class="flex text-xl font-bold space-x-2 items-center">
                        <x-far-calendar-alt class="w-6 h-6 text-indigo-600 dark:text-indigo-400 mr-2" />
                        FOSS TIMETABLE
                        @if (config('app.demo_mode'))
                            <span
                                class="bg-amber-50 border border-amber-200 text-amber-800 dark:bg-amber-950/30 dark:border-amber-500/30 dark:text-amber-400 dark:shadow-amber-900/20 text-xs px-2 py-1 ml-2 rounded-lg">DEMO</span>
                        @endif
                    </h2>
                </a>
            </div>

            <div class="flex md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="text-indigo-600 hover:text-indigo-800 focus:outline-none dark:text-indigo-400">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="hidden md:flex items-center space-x-6 font-bold">
                <x-nav-link href="/groups">Groups</x-nav-link>
                <x-nav-link href="/professors">Professors</x-nav-link>
                <x-nav-link href="/classrooms">Classrooms</x-nav-link>

                @auth
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button
                            class="p-2 rounded-md cursor-pointer text-red-500 hover:bg-red-500 hover:text-white transition-all duration-150">
                            Log out
                        </button>
                    </form>
                @endauth

                @guest
                    @if (!config('app.demo_mode'))
                        <a class="p-2 rounded-md hover:bg-indigo-600 hover:text-white transition-all duration-150
                        dark:hover:bg-indigo-400"
                            href="/login">Log in</a>
                        <a class="bg-indigo-600 text-white p-2 rounded-md hover:bg-indigo-700 transition-all duration-150
                        dark:bg-indigo-500"
                            href="/register">Register</a>
                    @endif
                @endguest
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" class="md:hidden pb-4 space-y-2 font-bold">

            <x-nav-link href="/groups" class="block py-2">Groups</x-nav-link>
            <x-nav-link href="/professors" class="block py-2">Professors</x-nav-link>
            <x-nav-link href="/classrooms" class="block py-2">Classrooms</x-nav-link>

            <hr class="border-indigo-100 my-2">

            @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button class="w-full text-left p-2 text-red-500">Log out</button>
                </form>
            @endauth

            @guest
                @if (!config('app.demo_mode'))
                    <a class="block p-2" href="/login">Log in</a>
                    <a class="block p-2 text-indigo-600" href="/register">Register</a>
                @endif
            @endguest
        </div>
    </nav>

    <section>
        {{ $slot }}
    </section>

</body>

</html>
