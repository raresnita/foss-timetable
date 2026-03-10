@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'block w-full bg-slate-100 border border-black/15 px-4 py-2 rounded-md text-sm 
            hover:border-indigo-500 focus:border-indigo-500 focus:outline-0
            dark:bg-slate-800 dark:border-white/15 dark:hover:border-indigo-400 dark:ring-1 dark:ring-white/10 
            dark:focus:border-indigo-400 dark:focus:outline-0
            shadow transition-all duration-150',
        'value' => old($name),
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes($defaults) }}>
</x-forms.field>
