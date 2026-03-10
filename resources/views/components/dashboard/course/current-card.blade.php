{{--@props(['course'])--}}

{{--<div class='bg-indigo-600 h-max p-4 rounded-xl border border-black/15 shadow'>--}}
{{--    <div>--}}
{{--        <h2 class="font-bold text-xl">--}}
{{--        </h2>--}}
{{--        <div class="flex flex-col md:flex-row md:gap-1">--}}
{{--            @if($course)--}}
{{--                <p>--}}
{{--                    <strong>{{ $course->subject->name }}</strong>--}}
{{--                </p>--}}
{{--                <p>--}}
{{--                    @if(Auth::user()->user_role === "stud")--}}
{{--                        with--}}
{{--                        <a href="/professors/{{$course->subject->professor->id}}">--}}
{{--                            <strong>{{ $course->subject->professor->name }}</strong>--}}
{{--                        </a>--}}
{{--                    @else--}}
{{--                        with group--}}
{{--                        <a href="/groups/{{'10'.$course->group_id}}">--}}
{{--                            <strong>{{ '10'.$course->group_id }}</strong>--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--                <p>in classroom--}}
{{--                    <a href="/classrooms/{{$course->classroom->name}}">--}}
{{--                        <strong>{{ $course->classroom->name }}</strong>--}}
{{--                    </a>--}}
{{--                </p>--}}
{{--            @else--}}
{{--                <p class="text-indigo-200 italic flex items-center">No course currently. Go grab a coffee! <x-fas-coffee class="ml-2 w-4 h-4"/></p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


@props(['course'])

<div class="h-max">
    @if($course)
        <div class="space-y-1">
            <h2 class="text-2xl font-bold tracking-tight">
                {{ $course->subject->name }}
            </h2>

            <div class="flex flex-wrap items-center gap-x-2 text-indigo-100 text-sm">
                @if(Auth::user()->user_role === "stud")
                    <span>with</span>
                    <a href="/professors/{{$course->subject->professor->id}}" class="font-semibold underline decoration-indigo-400 underline-offset-4 hover:text-white transition">
                        {{ $course->subject->professor->name }}
                    </a>
                @else
                    <span>with group</span>
                    <a href="/groups/{{'10'.$course->group_id}}" class="font-semibold underline decoration-indigo-400 underline-offset-4 hover:text-white transition">
                        {{ '10'.$course->group_id }}
                    </a>
                @endif

                <span class="text-indigo-400">•</span>

                <span>in classroom</span>
                <a href="/classrooms/{{$course->classroom->name}}" class="font-semibold underline decoration-indigo-400 underline-offset-4 hover:text-white transition">
                    {{ $course->classroom->name }}
                </a>
            </div>
        </div>
    @else
        <div class="flex items-center italic py-2 text-indigo-200/70  dark:text-indigo-300/50">
            <p>No course currently. Go grab a coffee!</p>
            <x-fas-coffee class="ml-3 w-5 h-5 opacity-50"/>
        </div>
    @endif
</div>
