@props(['entry', 'context'])

<div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow
dark:bg-slate-950 dark:border-slate-800 dark:hover:border-slate-700 dark:hover:shadow-lg dark:hover:shadow-indigo-500/10">

    <div class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-1
    dark:text-indigo-400">
        {{ $entry->start_hour }} - {{ $entry->end_hour }} - {{ $entry->course_type }}
    </div>

    <div class="text-lg font-bold text-slate-800 leading-tight dark:text-slate-100">
        {{ $entry->subject->name }}
    </div>

    <div class="text-sm mt-2 flex items-center">
        @if($context === 'professor')
            <x-fas-people-group class="w-4 h-4 text-slate-500 mr-2 dark:text-slate-400"/>
            <a href="/groups/{{ $entry->group->name }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                {{ $entry->group->name }}
            </a>
        @else
            <x-fas-user class="w-4 h-4 text-slate-500 mr-2 dark:text-slate-400"/>
            <a href="/professors/{{ $entry->subject->professor->id }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                {{ $entry->subject->professor->name }}
            </a>
        @endif
    </div>

    <div class="text-sm flex items-center">
        @if($context === 'classroom')
            <x-fas-people-group class="w-4 h-4 text-slate-500 mr-2 dark:text-slate-400"/>
            <a href="/groups/{{ $entry->group->name }}" class="text-slate-600 hover:underline dark:text-slate-300">
                {{ $entry->group->name }}
            </a>
        @else
            <x-fas-door-open class="w-4 h-4 text-slate-500 mr-2 dark:text-slate-400"/>
            <a href="/classrooms/{{ $entry->classroom->name }}" class="text-slate-600 hover:underline dark:text-slate-300">
                {{ $entry->classroom->name }}
            </a>
        @endif
    </div>
</div>
