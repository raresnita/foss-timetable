@props(['course', 'type' => 'current'])

<div {{$attributes->merge(['class' => ($type=== 'current' ? 'bg-teal-100'
: "bg-slate-50").' h-max p-4 rounded-xl shadow-sm border border-black/15 hover:border-teal-600 transition-all duration-125'])}}>
    <div>
        <h2 class="font-bold text-xl">{{$type === "current" ? "Current course" : "Next course"}}</h2>
        <div class="flex flex-col md:flex-row md:gap-1">
            @if($course)
                <p>
                    <strong>{{ $course->subject->name }}</strong>
                </p>
                <p>
                    @if(Auth::user()->user_role === "stud")
                        with
                        <a href="/professors/{{$course->subject->professor->id}}">
                            <strong>{{ $course->subject->professor->name }}</strong>
                        </a>
                    @else
                        with group
                        <a href="/groups/{{'10'.$course->group_id}}">
                            <strong>{{ '10'.$course->group_id }}</strong>
                        </a>
                    @endif
                </p>
                <p>in classroom
                    <a href="/classrooms/{{$course->classroom->name}}">
                        <strong>{{ $course->classroom->name }}</strong>
                    </a>
                </p>
            @else
                <p class="text-teal-800/50 italic">No course currently. Go grab a coffee! ☕</p>
            @endif
        </div>
    </div>
</div>
