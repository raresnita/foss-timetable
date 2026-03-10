<x-heading>Your schedule, simplified!</x-heading>
<div class="grid md:grid-cols-2 gap-6">
    <div>
        <h2 class="text-lg my-2">Never miss a lecture. Get real-time updates on your current classes and instant
            notifications from your professors.</h2>

        <a class='rounded-md bg-indigo-600 border border-black/15 px-3 py-2 text-sm/6 font-semibold text-white shadow hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-125 cursor-pointer
    dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:ring-1 dark:ring-white/10'
            href="/login">View your timetable</a>
    </div>
    <div
        class=" grid gap-2 p-8 bg-slate-50 dark:bg-slate-900 rounded-xl border border-black/15 dark:border-white/15 shadow-xl">
        <x-timetables.card :entry="App\Models\Timetable::factory()->make()" context="groups" />
        <x-timetables.card :entry="App\Models\Timetable::factory()->make()" context="groups" />
        <x-timetables.card :entry="App\Models\Timetable::factory()->make()" context="groups" />
    </div>
</div>
