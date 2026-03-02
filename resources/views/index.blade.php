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
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-6">

                <div class="lg:col-span-2 space-y-2 md:space-y-6">
                    <div
                        class="relative overflow-hidden rounded-2xl bg-indigo-700 p-6 text-white shadow border border-white/15
                        dark:bg-indigo-950/30 dark:border-indigo-500/20 dark:ring-1 dark:ring-white/10">
                        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/20 blur-3xl
                        dark:bg-indigo-500/10"></div>

                        <div class="relative flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold uppercase tracking-widest text-indigo-200/80">Current
                                Course</h3>
                            @if($currentCourse)
                                <div class="flex items-center gap-2 rounded-full bg-white/10 px-2 py-1">
                                    <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                    </span>
                                    <span class="text-[10px] font-bold uppercase text-white">Live</span>
                                </div>
                            @endif
                        </div>
                        <x-dashboard.course-card :course="$currentCourse"/>

                    </div>

                    <div class="lg:hidden">
                        <div class="h-full rounded-2xl border border-black/15 bg-slate-50/50 p-4 shadow  dark:bg-slate-900/50 dark:border-slate-800  dark:ring-1 dark:ring-white/10">
                            <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Next course</h3>
                            <x-dashboard.next-course-card :entry="$nextCourse" context="group" class="h-max"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if(Auth::user()->user_role === "stud")
                            <x-dashboard.notification-card :count="Auth::user()->notifications()->count()"/>
                        @else
                            <div class="flex flex-col justify-between p-5 bg-slate-50 border border-slate-200 rounded-2xl shadow
                            dark:bg-slate-900 dark:border-slate-800  dark:ring-1 dark:ring-white/10">
                                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-tight">Quick Actions</h3>
                                <div class="mt-4 flex flex-col sm:flex-row gap-3">
                                    <button command="show-modal" commandfor="dialog"
                                            class="flex-1 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow hover:bg-indigo-700 transition-all cursor-pointer">
                                            Send Notification
                                    </button>

                                    <el-dialog>
                                        <dialog id="dialog" aria-labelledby="dialog-title"
                                                class="fixed inset-0 rounded-2xl size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent transition-all duration-150">
                                            <el-dialog-backdrop
                                                class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                                            <div
                                                class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0 transition-all duration-150">
                                                <form action="{{ route('notifications.send') }}" method="POST"
                                                      class="w-full sm:max-w-lg">
                                                    @csrf
                                                    <el-dialog-panel
                                                        class="relative transform overflow-hidden  rounded-2xl  bg-slate-50 text-left shadow-xl transition-all duration-150 sm:my-8 sm:w-full">

                                                        <div class="bg-slate-50 px-4 pt-5 pb-4 sm:p-6">
                                                            <div class="sm:flex sm:items-start">
                                                                <div
                                                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                                    <h3 id="dialog-title"
                                                                        class="text-base font-semibold text-gray-900 ">
                                                                        Send notification</h3>

                                                                    <div class="mt-4">
                                                                        <label for="select"
                                                                               class="block text-sm/6 font-medium text-gray-900">Group</label>
                                                                        <el-select name="group_id" id="select" value="1"
                                                                                   class="mt-2 block">
                                                                            <button type="button"
                                                                                    class="grid w-full cursor-default rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 outline-gray-300 sm:text-sm/6">
                                                                                <el-selectedcontent
                                                                                    class="col-start-1 row-start-1 flex items-center gap-3 pr-6">
                                                                                    <span class="block truncate">Select Group</span>
                                                                                </el-selectedcontent>
                                                                                <svg viewBox="0 0 16 16"
                                                                                     fill="currentColor"
                                                                                     class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500">
                                                                                    <path
                                                                                        d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"/>
                                                                                </svg>
                                                                            </button>

                                                                            <el-options anchor="bottom start" popover
                                                                                        class="max-h-56 w-(--button-width) overflow-auto rounded-md bg-white py-1 text-base shadow-lg outline-1 outline-black/5 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">
                                                                                @foreach(\App\Models\Group::all() as $group)
                                                                                    <el-option value="{{ $group->id }}"
                                                                                               class="group/option relative block cursor-default py-2 pr-9 pl-3 text-gray-900 select-none focus:bg-indigo-600 focus:rounded-lg focus:text-white focus:outline-hidden transition-all duration-150">
                                                                                        <span
                                                                                            class="ml-3 block truncate font-normal">{{ $group->name }}</span>
                                                                                    </el-option>
                                                                                @endforeach
                                                                            </el-options>
                                                                        </el-select>
                                                                    </div>

                                                                    <div class="mt-4">
                                                                        <label for="notification-message"
                                                                               class="block text-sm/6 font-medium text-gray-900">Message</label>
                                                                        <div class="mt-2">
                                        <textarea id="notification-message" name="message" rows="3"
                                                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                                                        </div>
                                                                        <p class="mt-2 text-sm text-gray-500">Write your
                                                                            message for the students.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-gray-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                            <button type="submit"
                                                                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500   cursor-pointer sm:ml-3 sm:w-auto transition-all duration-150">
                                                                Send Notification
                                                            </button>
                                                            <button type="button" command="close" commandfor="dialog"
                                                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm cursor-pointer ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-all duration-150">
                                                                Cancel
                                                            </button>
                                                        </div>

                                                    </el-dialog-panel>
                                                </form>
                                            </div>
                                        </dialog>
                                    </el-dialog>

                                    <a href="#" class="flex-1 flex items-center justify-center rounded-xl bg-slate-100 px-4 py-3 text-sm shadow font-bold text-slate-700 hover:bg-slate-200 transition-all
                                    dark:bg-slate-800 dark:text-slate-200">
                                        Reschedule
                                    </a>
                                </div>
                            </div>
                        @endif

                        <a href="{{ Auth::user()->timetableUrl() }}"
                           class="group p-6 bg-indigo-50 border border-indigo-100 rounded-2xl flex items-center justify-between hover:bg-indigo-100 transition
                           dark:bg-indigo-950 dark:border-indigo-500/20 dark:ring-1 dark:ring-white/10 dark:hover:bg-indigo-900 shadow">
                            <div>
                                <p class="text-sm font-medium text-indigo-400 dark:text-indigo-200 tracking-widest uppercase">Your Schedule</p>
                                <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">View Timetable</p>
                            </div>
                            <div class="bg-indigo-600 text-white p-2 rounded-full group-hover:translate-x-1 transition-transform dark:bg-indigo-400 dark:text-slate-900">
                                <x-fas-arrow-right class="w-5 h-5"/>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block lg:col-span-1">
                    <div class="h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:bg-slate-900/50 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-sm font-bold uppercase tracking-widest  text-slate-400">Up Next</h3>
                            <x-fas-calendar-alt class="w-4 h-4 text-slate-300"/>
                        </div>
                        <x-dashboard.next-course-card :entry="$nextCourse" context="{{Auth::user()->user_role === 'prof' ? 'professor' : 'group'}}"/>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    @guest
        @if(config('app.demo_mode'))
            <x-hero.demo></x-hero.demo>
        @else
            <x-hero.standard></x-hero.standard>
        @endif
    @endguest
</x-layout>
