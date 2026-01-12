<x-layout>
    <x-heading>Classrooms</x-heading>

    <div>
        @foreach($classrooms as $classroom)
            <div>
                <a href="/classrooms/{{$classroom->name}}">{{$classroom->name}}</a>
            </div>
        @endforeach
    </div>
</x-layout>
