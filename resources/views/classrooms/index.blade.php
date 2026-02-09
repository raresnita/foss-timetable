<x-layout>
    <x-heading>Classrooms</x-heading>

    <div class="grid grid-cols-5 md:grid-cols-3 lg:grid-cols-6 2xl:grid-cols-8 gap-6">
        @foreach($classrooms as $classroom)
            <div class="bg-slate-50 rounded-xl flex justify-center text-center p-4 border border-black/15 overflow-hidden
            hover:border-teal-600 hover:shadow-md transition-shadow">
                <a href="/classrooms/{{$classroom->name}}">{{$classroom->name}}</a>
            </div>
        @endforeach
    </div>
</x-layout>
