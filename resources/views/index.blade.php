@php use Carbon\Carbon; @endphp
<x-layout>
    @auth

        @inject('timetableService', 'App\Services\TimetableService')

        @php
            $currentCourse = $timetableService->getCurrentCourse(Auth::user());
            $nextCourse = $timetableService->getNextCourse(Auth::user());
        @endphp

        <x-heading>Welcome</x-heading>

        @if(Auth::user()->user_role === 'admin')
            <a href="/manage/users">Manage users</a>
            <a href="/manage/classrooms">Manage classrooms</a>
            <a href="/manage/groups">Manage classrooms</a>
        @else
            <div class="grid grid-cols-2 grid-rows-2 gap-4">
                <x-course-card :course="$currentCourse" type="current"></x-course-card>
                <x-course-card :course="$nextCourse" type="next"></x-course-card>

                <div
                    class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        <h2>{{ Auth::user()->notifications()->count() }} notification</h2>
                        @foreach(Auth::user()->notifications as $notification)
                            <div class="notification-card">
                                <strong>{{ $notification->data['professor_name'] }}</strong>
                                for group
                                <strong>{{ $notification->data['group_name'] }}</strong>:
                                <p>{{ $notification->data['message'] }}</p>
                                <small>{{ Carbon::parse($notification->data['sent_at'])->diffForHumans() }}</small>
                            </div>
                        @endforeach()
                    </div>
                </div>
                <div
                    class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        @if(Auth::user()->user_role === 'prof')
                            <a href="/professors/{{ auth()->user()->id }}">View timetable</a>
                        @else
                            <a href="/groups/{{ Auth::user()->group->name }}">View timetable</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endauth

    @guest
        <x-heading>FOSS Timetable - a Laravel timetable management demo</x-heading>

        <div class="grid grid-cols-3 grid-rows-1 w-max gap-4">
            <div
                class="relative bg-slate-50 border border-slate-400 p-4 w-lg flex justify-center rounded-lg hover:shadow transition-all duration-150">
                <form method='POST' action='/demo-login/admin'>
                    @csrf
                    <div>
                        <button type="submit" class="after:absolute after:inset-0 cursor-pointer">Log in as admin
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="relative bg-slate-50 border border-slate-400 p-4 w-lg flex justify-center rounded-lg hover:shadow transition-all duration-150">
                <form method='POST' action='/demo-login/prof'>
                    @csrf
                    <div>
                        <button type="submit" class="after:absolute after:inset-0 cursor-pointer">Log in as professor
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="relative bg-slate-50 border border-slate-400 p-4 w-lg flex justify-center rounded-lg hover:shadow transition-all duration-150">
                <form method='POST' action='/demo-login/stud'>
                    @csrf
                    <div>
                        <button type="submit" class="after:absolute after:inset-0 cursor-pointer">Log in as student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class='bg-amber-200 font-bold p-3 mt-4 rounded-md shadow-lg w-max'><b>WARNING!</b> The database resets every
            24 hours.</p>
    @endguest
</x-layout>
