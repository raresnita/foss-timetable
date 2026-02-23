<x-layout>
    @auth

        @inject('timetableService', 'App\Services\TimetableService')

        @php
            $currentCourse = $timetableService->getCurrentCourse(Auth::user());
            $nextCourse = $timetableService->getNextCourse(Auth::user());
        @endphp

        <x-heading>Welcome, {{Auth::user()->name}}!</x-heading>

        @if(Auth::user()->user_role === 'admin')
            <a href="/manage/users">Manage users</a>
            <a href="/manage/classrooms">Manage classrooms</a>
            <a href="/manage/groups">Manage classrooms</a>
        @else
            <div class="grid grid-cols-1 grid-rows-4 md:grid-cols-2 md:grid-rows-2 gap-4">
                    <x-dashboard.course-card :course="$currentCourse" type="current"></x-dashboard.course-card>
                    <x-dashboard.course-card :course="$nextCourse" type="next"></x-dashboard.course-card>
                <div>
                    <x-dashboard.notification-card
                        :count="Auth::user()->notifications()->count()"></x-dashboard.notification-card>
                    <div
                        class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                        <div>
                            <a href={{Auth::user()->timetableUrl()}}>View your timetable</a>
                        </div>
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
