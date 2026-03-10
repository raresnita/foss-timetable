<x-layout>
    <x-heading>Timetable for {{ $owner->name ?? $owner->username }}</x-heading>
    <div class="p-8 bg-slate-50 rounded-xl border border-black/15 dark:bg-slate-900 shadow">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            @php
                $days = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday'];
            @endphp

            @foreach ($days as $dayNumber => $dayName)
                <div class="space-y-4">
                    <h2
                        class="text-xl font-semibold text-indigo-600 border-b-2 border-indigo-200 pb-2 dark:text-indigo-400">
                        {{ $dayName }}
                    </h2>

                    @forelse($timetable->get($dayNumber, []) as $entry)
                        <x-timetables.card :$entry :$context />
                    @empty
                        <div class="text-sm text-slate-400 italic">No courses</div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
