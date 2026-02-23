@props(['course', 'type' => 'current'])

<div {{$attributes->merge(['class' => ($type=== 'current' ? 'bg-teal-100  '
: "bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 ")
.'p-4 rounded-xl shadow-sm border border-black/15 hover:border-teal-600 transition-all duration-125'])}}>
    <div>
        <h2>{{$type === "current" ? "Current course" : "Next course"}}</h2>
        <div class="course-card">
            @if($course)
{{--                @php--}}
{{--                    dd($course)--}}
{{--                @endphp--}}
                <p>
                    <strong>{{ $course->subject->name }}</strong>
                    @if(Auth::user()->user_role === "stud")
                        with
                        <a href="/professors/{{$course->subject->professor->id}}">
                            <strong>{{ $course->subject->professor->name ?? 'N/A' }}</strong>
                        </a>
                    @else
                        with
                        <a href="/groups/{{'10'.$course->group_id}}">
                            <strong>{{ '10'.$course->group_id ?? 'N/A' }}</strong>
                        </a>
                    @endif
                </p>
                <p>in classroom
                    <a href="/classrooms/{{$course->classroom->name}}">
                        <strong>{{ $course->classroom->name }}</strong>
                    </a>
                </p>
            @else
                <p class="text-teal-800/50 italic">No class currently. Go grab a coffee! ☕</p>
            @endif
        </div>
    </div>
</div>
