<x-layout>
    <x-heading>Timetable for {{$owner->name ?? $owner->username}}</x-heading>
    <div class="p-8 bg-slate-50 rounded-xl border border-black/15">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            @php
                $days = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday'];
            @endphp

            @foreach($days as $dayNumber => $dayName)
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-teal-600 border-b-2 border-teal-200 pb-2">
                        {{ $dayName }}
                    </h2>

                    @forelse($timetable->get($dayNumber, []) as $entry)
                        {{-- We just pass the entry and context, let the card do the rest --}}
                        <x-timetables.card :$entry :$context />
                    @empty
                        <div class="text-sm text-slate-400 italic">No classes</div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
