<x-heading>Your schedule, simplified!</x-heading>
<div class="grid md:grid-cols-2 gap-6">
    <div>
        <h2 class="text-lg my-2">Never miss a lecture. Get real-time updates on your current classes and instant notifications from your
            professors.</h2>
        <a class="bg-indigo-600 text-white p-2 rounded-md hover:bg-indigo-700 transition-all duration-150"
           href="/login">View your timetable</a>
    </div>
    <div class=" grid gap-2 p-8 bg-slate-50 rounded-xl border border-black/15">
        <x-timetables.card :entry="App\Models\Timetable::factory()->make()" context="groups"/>
        <x-timetables.card :entry="App\Models\Timetable::factory()->make()" context="groups"/>
        <x-timetables.card :entry="App\Models\Timetable::factory()->make()" context="groups"/>
    </div>
</div>
