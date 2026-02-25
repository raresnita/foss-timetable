<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FOSS Timetable</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
</head>

<body class="bg-white text-black px-4 md:px-12">
@if (session('status') || session('error'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="fixed top-5 right-5 z-50 min-w-[300px]"
    >
        <div
            class="{{ session('error') ? 'bg-red-500' : 'bg-indigo-600' }} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center justify-between">
            <span>{{ session('status') ?? session('error') }}</span>
            <button @click="show = false" class="ml-4 hover:opacity-70">&times;</button>
        </div>
    </div>
@endif

<nav x-data="{ mobileMenuOpen: false }" class="border-b border-b-indigo-600">
    <div class="flex items-center justify-between py-4">
        <div>
            <a href="/">
                <h2 class="flex text-xl font-bold space-x-2 items-center">
                    <x-far-calendar-alt class="w-6 h-6 text-indigo-600"/>
                    FOSS TIMETABLE
                    @if(config('app.demo_mode'))
                        <span class="bg-amber-200 text-xs px-2 py-1 ml-2 rounded-lg">DEMO</span>
                    @endif
                </h2>
            </a>
        </div>

        <div class="flex md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="text-indigo-600 hover:text-indigo-800 focus:outline-none">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
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
                @if(!config('app.demo_mode'))
                    <a class="p-2 rounded-md hover:bg-indigo-600 hover:text-white transition-all duration-150"
                       href="/login">Log in</a>
                    <a class="bg-indigo-600 text-white p-2 rounded-md hover:bg-indigo-700 transition-all duration-150"
                       href="/register">Register</a>
                @endif
            @endguest
        </div>
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         class="md:hidden pb-4 space-y-2 font-bold">

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
            @if(!config('app.demo_mode'))
                <a class="block p-2" href="/login">Log in</a>
                <a class="block p-2 text-indigo-600" href="/register">Register</a>
            @endif
        @endguest
    </div>
</nav>

<section>
    {{$slot}}
</section>

</body>
</html>
