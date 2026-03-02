@props(['entry', 'context'])

<div class="py-4 rounded">
    <div class="flex md:flex-col gap-2 mb-1">
        <div class="text-xs font-bold text-indigo-500 uppercase tracking-wider dark:text-indigo-400">
            {{ $entry->start_hour }} - {{ $entry->end_hour }} - {{ $entry->course_type }}
        </div>
    </div>
    <div class="text-lg font-bold text-slate-800 leading-tight md:mt-4 dark:text-slate-200">
        {{ $entry->subject->name }}
    </div>


    <div class="flex flex-col gap-2 md:gap-2">
        <div class="text-sm mt-2 flex items-center">
            @if($context === 'professor')
                <x-fas-people-group class="w-4 h-4 text-slate-500 mr-2"/>
                <a href="/groups/{{ $entry->group->name }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                    {{ $entry->group->name }}
                </a>
            @else
                <x-fas-user class="w-4 h-4 text-slate-500 mr-2"/>
                <a href="/professors/{{ $entry->subject->professor->id }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                    {{ $entry->subject->professor->name }}
                </a>
            @endif
        </div>

        <div class="sm:text-sm flex items-center">
            @if($context === 'classroom')
                <x-fas-people-group class="w-4 h-4 text-slate-500 mr-2"/>
                <a href="/groups/{{ $entry->group->name }}" class="text-slate-600 hover:underline dark:text-slate-400">
                    {{ $entry->group->name }}
                </a>
            @else
                <x-fas-door-open class="w-4 h-4 text-slate-500 mr-2"/>
                <a href="/classrooms/{{ $entry->classroom->name }}" class="text-slate-600 hover:underline dark:text-slate-400">
                    {{ $entry->classroom->name }}
                </a>
            @endif
        </div>
    </div>
</div>
