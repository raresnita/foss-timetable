<x-layout>
    <x-heading>Professors</x-heading>

    <div class="grid grid-cols-5 md:grid-cols-3 lg:grid-cols-6 2xl:grid-cols-8 gap-6">
        @foreach($professors as $professor)
            <div class="bg-slate-50 rounded-xl flex justify-center text-center w-50 pb-4 border border-black/15 overflow-hidden
            hover:border-teal-600 hover:shadow-md transition-shadow">
                <a href="/professors/{{$professor->id}}">
                    <img class="pb-4" src="http://picsum.photos/seed/{{rand(0, 100)}}/200/200" alt="{{$professor->name}}">
                    {{$professor->name}}
                </a>
            </div>
        @endforeach
    </div>
</x-layout>
