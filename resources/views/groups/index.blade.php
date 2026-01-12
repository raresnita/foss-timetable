<x-layout>
    <x-heading>Groups</x-heading>

    <div>
        @foreach($groups as $group)
            <div>
                <a href="/groups/{{$group->name}}">{{$group->name}}</a>
            </div>
        @endforeach
    </div>
</x-layout>
