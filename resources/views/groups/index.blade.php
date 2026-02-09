<x-layout>
    <x-heading>Groups</x-heading>

    <div class="grid grid-cols-5 md:grid-cols-3 lg:grid-cols-6 2xl:grid-cols-8 gap-6">
        @foreach($groups as $group)
            <div class="bg-slate-50 rounded-xl flex justify-center text-center p-4 border border-black/15 overflow-hidden
            hover:border-teal-600 hover:shadow-md transition-shadow">
                <a href="/groups/{{$group->name}}">{{$group->name}}</a>
            </div>
        @endforeach
    </div>
</x-layout>
