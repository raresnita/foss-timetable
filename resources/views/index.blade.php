<x-layout>
    @auth
        <x-heading>{{ __('ui.welcome', ['name' => Auth::user()->name]) }}</x-heading>

        @if (Auth::user()->user_role === 'admin')
            <x-index.admin />
        @else
            <x-index.users />
        @endif
    @endauth

    @guest
        @if (config('app.demo_mode'))
            <x-hero.demo />
        @else
            <x-hero.standard />
        @endif
    @endguest
</x-layout>
