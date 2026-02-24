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

                @if(Auth::user()->user_role === "stud")
                    <x-dashboard.notification-card
                        :count="Auth::user()->notifications()->count()"></x-dashboard.notification-card>
                @else
                    <div>
                        <button command="show-modal" commandfor="dialog"
                                class="rounded-md bg-slate-50/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">
                            Send notification
                        </button>
                        <el-dialog>
                            <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                                <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <form action="{{ route('notifications.send') }}" method="POST" class="w-full sm:max-w-lg">
                                        @csrf
                                        <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-slate-50 text-left shadow-xl transition-all sm:my-8 sm:w-full">

                                            <div class="bg-slate-50 px-4 pt-5 pb-4 sm:p-6">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                        <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Send notification</h3>

                                                        <div class="mt-4">
                                                            <label for="select" class="block text-sm/6 font-medium text-gray-900">Group</label>
                                                            <el-select name="group_id" id="select" value="1" class="mt-2 block">
                                                                <button type="button" class="grid w-full cursor-default rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 outline-gray-300 sm:text-sm/6">
                                                                    <el-selectedcontent class="col-start-1 row-start-1 flex items-center gap-3 pr-6">
                                                                        <span class="block truncate">Select Group</span>
                                                                    </el-selectedcontent>
                                                                    <svg viewBox="0 0 16 16" fill="currentColor" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500">
                                                                        <path d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" />
                                                                    </svg>
                                                                </button>

                                                                <el-options anchor="bottom start" popover class="max-h-56 w-(--button-width) overflow-auto rounded-md bg-white py-1 text-base shadow-lg outline-1 outline-black/5 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">
                                                                    @foreach(\App\Models\Group::all() as $group)
                                                                        <el-option value="{{ $group->id }}" class="group/option relative block cursor-default py-2 pr-9 pl-3 text-gray-900 select-none focus:bg-indigo-600 focus:rounded-lg focus:text-white focus:outline-hidden transition-all duration-150">
                                                                            <span class="ml-3 block truncate font-normal">{{ $group->name }}</span>
                                                                        </el-option>
                                                                    @endforeach
                                                                </el-options>
                                                            </el-select>
                                                        </div>

                                                        <div class="mt-4">
                                                            <label for="notification-message" class="block text-sm/6 font-medium text-gray-900">Message</label>
                                                            <div class="mt-2">
                                        <textarea id="notification-message" name="message" rows="3"
                                                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                                            </div>
                                                            <p class="mt-2 text-sm text-gray-500">Write your message for the students.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bg-gray-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500 sm:ml-3 sm:w-auto">
                                                    Send Notification
                                                </button>
                                                <button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                    Cancel
                                                </button>
                                            </div>

                                        </el-dialog-panel>
                                    </form>
                                </div>
                            </dialog>
                        </el-dialog>
                        <div>
                            <a href="#">Reschedule course</a>
                        </div>
                    </div>
                @endif
                <div
                    class="bg-slate-50 p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125">
                    <div>
                        <a href={{Auth::user()->timetableUrl()}}>View your timetable</a>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    @guest
        <x-heading>FOSS Timetable - a Laravel timetable management demo</x-heading>

        <div class="grid sm:grid-rows-3 md:grid-cols-3 md:grid-rows-1 gap-4">
            <div
                class="relative bg-slate-50 border border-slate-400 p-4 flex justify-center rounded-lg hover:shadow transition-all duration-150">
                <form method='POST' action='/demo-login/admin'>
                    @csrf
                    <div>
                        <button type="submit" class="after:absolute after:inset-0 cursor-pointer">Log in as admin
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="relative bg-slate-50 border border-slate-400 p-4 flex justify-center rounded-lg hover:shadow transition-all duration-150">
                <form method='POST' action='/demo-login/prof'>
                    @csrf
                    <div>
                        <button type="submit" class="after:absolute after:inset-0 cursor-pointer">Log in as professor
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="relative bg-slate-50 border border-slate-400 p-4 flex justify-center rounded-lg hover:shadow transition-all duration-150">
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
