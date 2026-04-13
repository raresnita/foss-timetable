@props(['items', 'context'])

<x-layout>
    <x-heading>{{ Str::ucfirst(__("ui.$context")) }}</x-heading>

    <div class="grid md:grid-cols-5 lg:grid-cols-6 2xl:grid-cols-8 gap-4 md:gap-6">
        @foreach ($items as $item)
            <a href="/{{ $context }}/{{ $context === 'professors' ? $item->id : $item->name }}"
                class="flex items-center md:block text-center bg-white border border-black/15 p-6 rounded-xl hover:bg-slate-200 hover:border-indigo-500 
dark:bg-slate-900 dark:border-white/15 dark:hover:border-indigo-400 hover:dark:bg-slate-800 dark:ring-1 dark:ring-white/10 
shadow transition-all duration-150">
                @if ($context === 'professors')
                    <img src="http://picsum.photos/seed/{{ rand(0, 100) }}/200/200" alt="{{ $item->name }}"
                        class="w-20 mr-4 rounded-md md:w-auto md:m-0">
                @endif
                <p class=''>{{ $item->name }}</p>
            </a>
        @endforeach
    </div>
</x-layout>
