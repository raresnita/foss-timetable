@php use Illuminate\Support\Facades\Auth; @endphp
<x-layout>
    @auth
        <x-heading>Welcome</x-heading>
        @if(Auth::user()->user_role === 'admin')
            <a href="/manage/users">Manage users</a>
            <a href="/manage/classrooms">Manage classrooms</a>
            <a href="/manage/groups">Manage classrooms</a>
        @else
            <div class="grid grid-cols-2 grid-rows-2 gap-4">
                <div
                    class="bg-teal-100 p-4 rounded-xl shadow-sm border border-teal-600/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        <h2>Current class</h2>
                        <div class="course-card">
                            <p><strong>Cloud Computing Services</strong> with <strong>Reanna Smitham</strong></p>
                            <p>in classroom <strong>CR1</strong></p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        <h2>Next class</h2>
                        <div class="course-card">
                            <p><strong>Functional Programming</strong> with <strong>Rory Lynch</strong></p>
                            <p>in classroom <strong>CR4</strong></p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        <h2>{{Auth::user()->notifications()->count()}} notification</h2>
                        @foreach(Auth::user()->notifications as $notification)
                            <div class="notification-card">
                                <strong>{{ $notification->data['professor_name'] }}</strong>
                                for group <strong>{{ $notification->data['group_name'] }}</strong>:
                                <p>{{ $notification->data['message'] }}</p>
                                <small>{{ \Carbon\Carbon::parse($notification->data['sent_at'])->diffForHumans() }}</small>
                            </div>
                        @endforeach()
                    </div>
                </div>
                <div
                    class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        @if(Auth::user()->user_role === 'prof')
                            <a href="/professors/{{auth()->user()->id}}">View timetable</a>
                        @else
                            <a href="/groups/{{Auth::user()->group->name}}">View timetable</a>


                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endauth

    @guest
        <x-heading>FOSS Timetable - a Laravel timetable management demo</x-heading>
        
        <p class='bg-amber-200 font-bold p-3 rounded-md shadow-lg w-max'><b>WARNING!</b> The database resets every 24 hours.</p>
    @endguest
</x-layout>
