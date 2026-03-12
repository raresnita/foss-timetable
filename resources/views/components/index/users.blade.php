@inject('timetableService', 'App\Services\TimetableService')

@php
    $currentCourse = $timetableService->getCurrentCourse(Auth::user());
    $nextCourse = $timetableService->getNextCourse(Auth::user());
@endphp


<div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-6">

    <div class="lg:col-span-2 space-y-2 md:space-y-6">
        <div
            class="relative overflow-hidden rounded-2xl bg-indigo-700 p-6 text-white shadow border border-white/15
                        dark:bg-indigo-950/30 dark:border-indigo-500/20 dark:ring-1 dark:ring-white/10">
            <div
                class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/20 blur-3xl
                        dark:bg-indigo-500/10">
            </div>

            <div class="relative flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold uppercase tracking-widest text-indigo-200/80">Current Course</h3>
            </div>
            <x-dashboard.course.current-card :course="$currentCourse" />

        </div>

        <div class="lg:hidden">
            <div
                class="h-full rounded-2xl border border-black/15 bg-slate-50/50 p-4 shadow  dark:bg-slate-900/50 dark:border-black/15 dark:ring-1 dark:ring-white/10">
                <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Next course</h3>
                <x-dashboard.course.next-card :entry="$nextCourse" context="group" class="h-max" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if (Auth::user()->user_role === 'stud')
                <x-dashboard.notification-card :count="Auth::user()->notifications()->count()" />
            @else
                <div
                    class="flex flex-col justify-between p-5 bg-slate-50 border border-slate-200 rounded-2xl shadow
                            dark:bg-slate-900 dark:border-slate-800  dark:ring-1 dark:ring-white/10">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-tight">Quick Actions</h3>
                    <div class="mt-4 flex flex-col sm:flex-row gap-3">
                        <button command="show-modal" commandfor="dialog"
                            class="flex-1 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow hover:bg-indigo-700 transition-all cursor-pointer">
                            Send Notification
                        </button>

                        <el-dialog>
                            <dialog id="dialog" aria-labelledby="dialog-title"
                                class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-slate-950/50 dark:backdrop:bg-black/80 transition-all duration-150">
                                <el-dialog-backdrop class="fixed inset-0 transition-opacity"></el-dialog-backdrop>

                                <div class="flex min-h-full items-center justify-center p-4">
                                    <el-dialog-panel
                                        class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:w-full sm:max-w-lg border border-transparent dark:border-slate-800 ring-1 ring-black/5 dark:ring-white/10">

                                        <form action="{{ route('notifications.send') }}" method="POST">
                                            @csrf

                                            <div class="px-6 py-6">
                                                <h3 id="dialog-title"
                                                    class="text-lg font-bold text-gray-900 dark:text-white border-b dark:border-slate-800 pb-3">
                                                    Send Notification
                                                </h3>

                                                <div class="mt-6 space-y-5">
                                                    <div>
                                                        <label for="select"
                                                            class="block text-sm font-semibold text-gray-900 dark:text-slate-200">
                                                            Recipient Group
                                                        </label>
                                                        <el-select name="group_id" id="select" value="1"
                                                            class="mt-2 block w-full">
                                                            <button type="button"
                                                                class="grid w-full cursor-pointer rounded-lg bg-slate-50 dark:bg-slate-800 py-2.5 pr-2 pl-3 text-left text-gray-900 dark:text-slate-200 outline-1 outline-gray-300 dark:outline-slate-700 sm:text-sm">
                                                                <el-selectedcontent
                                                                    class="col-start-1 row-start-1 flex items-center gap-3 pr-6">
                                                                    <span class="block truncate">Select a
                                                                        group...</span>
                                                                </el-selectedcontent>
                                                                <svg viewBox="0 0 16 16" fill="currentColor"
                                                                    class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500">
                                                                    <path
                                                                        d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" />
                                                                </svg>
                                                            </button>

                                                            <el-options anchor="bottom start" popover
                                                                class="max-h-56 w-(--button-width) overflow-auto rounded-xl bg-slate-50 dark:bg-slate-800 py-1 text-base shadow-xl border border-slate-200 dark:border-slate-700 sm:text-sm">
                                                                @foreach (\App\Models\Group::all() as $group)
                                                                    <el-option value="{{ $group->id }}"
                                                                        class="relative block cursor-pointer py-2 px-4 text-gray-900 dark:text-slate-200 select-none focus:bg-indigo-600 focus:text-white transition-colors">
                                                                        <span
                                                                            class="block truncate font-normal">{{ $group->name }}</span>
                                                                    </el-option>
                                                                @endforeach
                                                            </el-options>
                                                        </el-select>
                                                    </div>

                                                    <div>
                                                        <label for="notification-message"
                                                            class="block text-sm font-semibold text-gray-900 dark:text-slate-200">
                                                            Message Content
                                                        </label>
                                                        <div class="mt-2">
                                                            <textarea id="notification-message" name="message" rows="4" required placeholder="Type your announcement here..."
                                                                class="block w-full rounded-lg bg-slate-50 dark:bg-slate-800 px-3 py-2.5 text-base text-gray-900 dark:text-slate-200 outline-1 outline-gray-300 dark:outline-slate-700 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"></textarea>
                                                        </div>
                                                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                                            This will be sent to all students currently enrolled
                                                            in the selected group.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">
                                                <button type="button" command="close" commandfor="dialog"
                                                    class="cursor-pointer rounded-lg bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-900 dark:text-slate-200 shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="cursor-pointer inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-indigo-600 transition-all">
                                                    Send Notification
                                                </button>
                                            </div>
                                        </form>

                                    </el-dialog-panel>
                                </div>
                            </dialog>
                        </el-dialog>

                        <a href="#"
                            class="flex-1 flex items-center justify-center rounded-xl bg-slate-100 px-4 py-3 text-sm shadow font-bold text-slate-700 hover:bg-slate-200 transition-all
                                    dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                            Reschedule
                        </a>
                    </div>
                </div>
            @endif

            <a href="{{ Auth::user()->timetableUrl() }}"
                class="group p-6 bg-indigo-50 border border-indigo-100 rounded-2xl flex items-center justify-between hover:bg-indigo-100 transition
                           dark:bg-indigo-950 dark:border-indigo-500/20 dark:ring-1 dark:ring-white/10 dark:hover:bg-indigo-900 shadow">
                <div>
                    <p class="text-sm font-medium text-indigo-400 dark:text-indigo-200 tracking-widest uppercase">
                        Your Schedule</p>
                    <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">View Timetable</p>
                </div>
                <div
                    class="bg-indigo-600 text-white p-2 rounded-full group-hover:translate-x-1 transition-transform dark:bg-indigo-400 dark:text-slate-900">
                    <x-fas-arrow-right class="w-5 h-5" />
                </div>
            </a>
        </div>
    </div>

    <div class="hidden lg:block lg:col-span-1">
        <div
            class="h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:bg-slate-900/50 dark:border-slate-800 dark:ring-1 dark:ring-white/10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-sm font-bold uppercase tracking-widest  text-slate-400">Up Next</h3>
                <x-fas-calendar-alt class="w-4 h-4 text-slate-300" />
            </div>
            <x-dashboard.course.next-card :entry="$nextCourse"
                context="{{ Auth::user()->user_role === 'prof' ? 'professor' : 'group' }}" />
        </div>
    </div>
</div>
