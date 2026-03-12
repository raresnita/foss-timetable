@props(['title', 'description', 'href', 'icon' => null])

<a href="{{ $href }}"
    class="group block p-6 bg-white border border-slate-200 rounded-xl shadow-sm transition-all duration-200 
    hover:shadow-md hover:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:hover:border-indigo-400">
    <div class="flex items-center justify-between mb-4">
        <h3
            class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-150">
            {{ $title }}
        </h3>
        @if ($icon)
            <x-dynamic-component :component="$icon"
                class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-all duration-150" />
        @endif
    </div>
    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
        {{ $description }}
    </p>
</a>
