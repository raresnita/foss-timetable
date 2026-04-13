@inject('timetableService', 'App\Services\TimetableService')

@php
    $currentCourse = $timetableService->getCurrentCourse(Auth::user());
    $nextCourse = $timetableService->getNextCourse(Auth::user());
    $boundaries = $timetableService->getDayBoundaries(Auth::user());
@endphp


{{-- <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-6">

    <div class="lg:col-span-2 space-y-2 md:space-y-6">
        <div
            class="relative overflow-hidden rounded-2xl bg-indigo-700 p-6 text-white ring-2 ring-black/10
                        dark:bg-indigo-950/30 dark:ring-white/10
                        hover:shadow-lg transition-all duration-150">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>
            <div class="relative flex items-center justify-between mb-4">

                <h3 class="text-sm font-bold uppercase tracking-widest text-indigo-200/80">Current Course</h3>
            </div>
            <x-dashboard.course.current-card :course="$currentCourse" />

        </div>

        <div class="lg:hidden">
            <div
                class="h-full rounded-2xl border border-black/15 bg-slate-50/50 p-4 shadow  dark:bg-slate-900/50 dark:border-black/15 dark:ring-1 dark:ring-white/10">
                <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Next course</h3>
                <x-timetables.card :entry="$nextCourse" context="group" class="h-max" />
                @if (Auth::user()->user_role === 'prof')
                    <a href="#"
                        class="mt-2 flex items-center justify-center rounded-lg bg-slate-100 px-4 py-3 text-sm shadow font-bold text-slate-700 hover:bg-slate-200
                             transition-all
                            dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700
                            border border-black/15">
                        Reschedule
                    </a>
                @endif
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if (Auth::user()->user_role === 'stud')
                <x-dashboard.notification-card :count="Auth::user()->notifications()->count()" />
            @else
                <div
                    class="flex flex-col justify-between p-5 bg-white border border-slate-200 rounded-2xl shadow
                            dark:bg-slate-900 dark:border-slate-800  dark:ring-1 dark:ring-white/10">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-tight">Notifications</h3>
                    <div class="mt-4 flex flex-col sm:flex-row gap-3">
                        <button command="show-modal" commandfor="send-notification-modal"
                            class="flex-1 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow hover:bg-indigo-700 transition-all cursor-pointer">
                            Send
                        </button>

                        <x-dashboard.modal id="send-notification-modal" title="Send Notification">
                            <form action="{{ route('notifications.send') }}" method="POST" id="notif-form">
                                @csrf
                                <div class="space-y-5">
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-900 dark:text-slate-200">Recipient
                                            Group</label>
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
                                        <label
                                            class="block text-sm font-semibold text-gray-900 dark:text-slate-200">Message
                                            Content</label>
                                        <textarea name="message" rows="4"
                                            class="block w-full rounded-lg bg-slate-50 dark:bg-slate-800 px-3 py-2.5 text-base text-gray-900 dark:text-slate-200 outline-1 outline-gray-300 dark:outline-slate-700 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"
                                            required></textarea>
                                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                            This will be sent to all students currently enrolled
                                            in the selected group.
                                        </p>
                                    </div>
                                </div>
                            </form>

                            <x-slot:footer>
                                <button type="button" command="close" commandfor="send-notification-modal"
                                    class="cursor-pointer rounded-lg bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-900 dark:text-slate-200 shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                                    Cancel
                                </button>
                                <button type="submit" form="notif-form"
                                    class="cursor-pointer inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-indigo-600 transition-all">
                                    Send Notification
                                </button>
                            </x-slot:footer>
                        </x-dashboard.modal>

                        <a href="#"
                            class="flex-1 flex items-center justify-center rounded-xl bg-slate-100 px-4 py-3 text-sm shadow font-bold text-slate-700 hover:bg-slate-200
                             transition-all
                            dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700
                            border border-black/15">
                            Archive
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
                <h3 class="text-sm font-bold uppercase tracking-widest  text-slate-400">Future courses</h3>
                <x-fas-calendar-alt class="w-4 h-4 text-slate-300" />
            </div>
            <x-timetables.card :entry="$nextCourse"
                context="{{ Auth::user()->user_role === 'prof' ? 'professor' : 'group' }}" />

            @if (Auth::user()->user_role === 'prof')
                <a href="#"
                    class="flex-1 flex items-center justify-center rounded-lg bg-slate-100 px-4 py-3 text-sm shadow font-bold text-slate-700 hover:bg-slate-200
                             transition-all
                            dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700
                            border border-black/15">
                    Reschedule
                </a>
            @endif
        </div>


    </div>
</div> --}}

<div class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-8 max-w-400 mx-auto">

    <div class="lg:col-span-8 space-y-4 md:space-y-8">
        <section
            class="bg-indigo-700 text-white w-full rounded-3xl p-6 border-slate-200 dark:border-slate-800 shadow-sm
        dark:bg-indigo-800/50 ">
            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-100">Current Course</h3>
            <x-dashboard.course.current-card :course="$currentCourse" />
        </section>

        <section x-data="{
            serverOffset: {{ now('Europe/Bucharest')->getTimestamp() * 1000 }} - Date.now(),
            startHour: {{ $boundaries['start'] }},
            endHour: {{ $boundaries['end'] }},
            currentPct: 0,
            displayTime: '{{ now('Europe/Bucharest')->format('H:i') }}',
        
            update() {
                let now = new Date(Date.now() + this.serverOffset);
                let hours = now.getHours() + (now.getMinutes() / 60) + (now.getSeconds() / 3600);
        
                // Update percentage
                let pct = ((hours - this.startHour) / (this.endHour - this.startHour)) * 100;
                this.currentPct = Math.max(0, Math.min(100, pct));
        
                // Update display string
                this.displayTime = now.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
            }
        }" x-init="update();
        setInterval(() => update(), 1000)"
            class="bg-white dark:bg-slate-800/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">Day Progress</h3>
                <span x-text="displayTime"
                    class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 px-2 py-1 rounded-md">
                    {{ now('Europe/Bucharest')->format('H:i') }}
                </span>
            </div>

            <div class="relative h-4 w-full bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                <div class="absolute top-0 left-0 h-full bg-indigo-600 text-indigo-600 transition-all duration-1000 ease-linear dark:bg-indigo-800 dark:text-indigo-800"
                    :style="`width: ${currentPct}%`">

                    <div
                        class="absolute inset-0 bg-linear-to-r from-transparent via-white/20 to-transparent animate-pulse">
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                <span>{{ sprintf('%02d:00', $boundaries['start']) }}</span>
                <span class="text-indigo-500/50 dark:text-indigo-400">Current Progress</span>
                <span>{{ sprintf('%02d:00', $boundaries['end']) }}</span>
            </div>
        </section>

        <section class="space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-600 px-2">Upcoming Schedule</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-timetables.card :entry="$nextCourse"
                    context="{{ Auth::user()->user_role === 'prof' ? 'professor' : 'group' }}" class="bg-white" />

                <div
                    class="hidden md:flex flex-col justify-center items-center border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-6">
                    <p class="text-slate-400 text-sm italic">No other courses scheduled for today.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="lg:col-span-4 space-y-6">

        <div class="space-y-3">
            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-600 px-2">Commands</h3>

            <a href="{{ Auth::user()->timetableUrl() }}"
                class="group flex items-center justify-between p-4 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                <div class="flex items-center gap-4">
                    <x-fas-calendar-alt class="w-5 h-5 text-indigo-200" />
                    <span class="font-bold">View full timetable</span>
                </div>
                <x-fas-chevron-right class="w-3 h-3 opacity-50 group-hover:translate-x-1 transition-transform" />
            </a>

            @if (Auth::user()->user_role === 'prof')
                <button
                    class="w-full flex items-center gap-4 p-4 bg-white border border-slate-200 text-slate-700 rounded-2xl hover:bg-slate-50 transition dark:bg-slate-900 dark:border-slate-800 dark:text-slate-200 shadow-sm">
                    <div class="bg-indigo-100 dark:bg-indigo-500/20 p-2 rounded-lg">
                        <x-fas-clock class="w-4 h-4 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <span class="font-bold text-sm">Reschedule Course</span>
                </button>
            @endif
        </div>

        <div>
            @if (Auth::user()->user_role === 'stud')
                <x-dashboard.notification-card :count="Auth::user()->notifications()->count()" />
            @else
                <div
                    class="p-5 bg-white border border-slate-200 rounded-3xl shadow-sm dark:bg-slate-900 dark:border-slate-800 dark:ring-1 dark:ring-white/10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-tight">Broadcast</h3>
                        <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button command="show-modal" commandfor="send-notification-modal"
                            class="w-full rounded-xl bg-slate-900 dark:bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow hover:opacity-90 transition-all cursor-pointer text-center">
                            Send New Alert
                        </button>

                        <x-dashboard.modal id="send-notification-modal" title="Send Notification">
                            <form action="{{ route('notifications.send') }}" method="POST" id="notif-form">
                                @csrf
                                <div class="space-y-5">
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-900 dark:text-slate-200">Recipient
                                            Group</label>
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
                                        <label
                                            class="block text-sm font-semibold text-gray-900 dark:text-slate-200">Message
                                            Content</label>
                                        <textarea name="message" rows="4"
                                            class="block w-full rounded-lg bg-slate-50 dark:bg-slate-800 px-3 py-2.5 text-base text-gray-900 dark:text-slate-200 outline-1 outline-gray-300 dark:outline-slate-700 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"
                                            required></textarea>
                                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
                                            This will be sent to all students currently enrolled
                                            in the selected group.
                                        </p>
                                    </div>
                                </div>
                            </form>

                            <x-slot:footer>
                                <button type="button" command="close" commandfor="send-notification-modal"
                                    class="cursor-pointer rounded-lg bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-900 dark:text-slate-200 shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                                    Cancel
                                </button>
                                <button type="submit" form="notif-form"
                                    class="cursor-pointer inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-indigo-600 transition-all">
                                    Send Notification
                                </button>
                            </x-slot:footer>
                        </x-dashboard.modal>

                        <a href="#"
                            class="w-full flex items-center justify-center rounded-xl bg-slate-100 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-200 transition-all dark:bg-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700">
                            View Archive
                        </a>
                    </div>
                </div>

                <x-dashboard.modal id="send-notification-modal" title="Send Notification">
                </x-dashboard.modal>
            @endif
        </div>

        {{-- <div
            class="hidden lg:block p-6 rounded-3xl bg-slate-50 dark:bg-slate-900/30 border border-slate-100 dark:border-slate-800/50">
            <h4 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase mb-2">Did you know?</h4>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                You can sync your school timetable with Google Calendar or iCal by visiting your profile settings.
            </p>
        </div> --}}
    </div>
</div>
