<x-heading>FOSS Timetable - a Laravel timetable management demo</x-heading>
<h2>A high-performance rewrite of my Bachelor Thesis. Explore complex scheduling logic, role-based notifications, and a robust data architecture.</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <x-demo-card role="stud" title="Login as student" description="View courses and notifications" />
    <x-demo-card role="prof" title="Login as professor" description="Broadcast alerts" />
    <x-demo-card role="admin" title="Login as admin" description="Manage the school structure" />
</div>

<div class="mt-8 inline-flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-800 px-4 py-2 rounded-lg shadow-sm">
        <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
        </span>
    <p class="text-sm font-medium">
        <strong>Demo Environment:</strong> The database resets every 24 hours.
    </p>
</div>
