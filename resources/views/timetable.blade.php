<x-layout>
    <x-heading>{{ __('ui.timetable_header') }} {{ $owner->name ?? $owner->username }}</x-heading>
    <div class="p-8 bg-white rounded-xl border border-black/15 dark:bg-slate-900 shadow">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            @php
                $days = collect(range(1, 5))->mapWithKeys(function ($i) {
                    return [
                        $i => \Carbon\Carbon::now()
                            ->startOfWeek()
                            ->addDays($i - 1)
                            ->translatedFormat('l'),
                    ];
                });
            @endphp

            @foreach ($days as $dayNumber => $dayName)
                <div class="space-y-4">
                    <h2
                        class="text-xl font-semibold text-indigo-600 border-b-2 border-indigo-200 pb-2 dark:text-indigo-400">
                        {{ Str::ucfirst($dayName) }}
                    </h2>

                    @forelse($timetable->get($dayNumber, []) as $entry)
                        <x-timetables.card :$entry :$context />
                    @empty
                        <div class="text-sm text-slate-400 italic">{{ __('ui.course_none') }}</div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
