@props(['entry', 'context'])

<div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">

    <div class="text-xs font-bold text-teal-500 uppercase tracking-wider mb-1">
        {{ $entry->start_hour }}:00 - {{ $entry->end_hour }}:00 - {{ $entry->course_type }}
    </div>


    <div class="text-lg font-bold text-slate-800 leading-tight">
        {{ $entry->subject->name }}
    </div>

    <div class="text-sm text-slate-600 mt-2 flex items-center">
        <span class="mr-2">👤</span>
        @if($context === 'professor')
            <a href="/groups/{{ $entry->group->name }}" class="text-teal-600 hover:underline">
                {{ $entry->group->name }}
            </a>
        @else
            <a href="/professors/{{ $entry->subject->professor->id }}" class="text-teal-600 hover:underline">
                {{ $entry->subject->professor->name }}
            </a>
        @endif
    </div>

    <div class="text-sm text-slate-500 flex items-center">
        @if($context === 'classroom')
            <span class="mr-2">👥</span>
            <a href="/groups/{{ $entry->group->name }}" class="text-slate-600 hover:underline">
                {{ $entry->group->name }}
            </a>
        @else
            <span class="mr-2">📍</span>
            <a href="/classrooms/{{ $entry->classroom->name }}" class="text-slate-600 hover:underline">
                {{ $entry->classroom->name }}
            </a>
        @endif
    </div>
</div>
