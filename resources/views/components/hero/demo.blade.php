<x-heading>{{ __('hero.demo_header') }}</x-heading>
<h2>{{ __('hero.demo_desc') }}</h2>

<div class="flex my-4 gap-2">
    <a class='rounded-md bg-indigo-600 border border-black/15 px-3 py-2 text-sm/6 font-semibold text-white shadow hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-125 cursor-pointer
    dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:ring-1 dark:ring-white/10'
        href="https://github.com/raresnita/foss-timetable">{{ __('hero.demo_github') }}</a>
    <a class='rounded-md bg-white border border-black/15 px-3 py-2 text-sm/6 font-semibold text-black shadow hover:bg-slate-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
    dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700 dark:ring-1 dark:ring-white/10
    transition-all duration-125 cursor-pointer'
        href="https://github.com/raresnita/foss-timetable/wiki">{{ __('hero.demo_docs') }}</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <x-demo-card role="stud" title="{{ __('hero.demo_stud_login') }}" description="{{ __('hero.demo_stud_desc') }}" />
    <x-demo-card role="prof" title="{{ __('hero.demo_prof_login') }}" description="{{ __('hero.demo_prof_desc') }}" />
    <x-demo-card role="admin" title="{{ __('hero.demo_admin_login') }}"
        description="{{ __('hero.demo_admin_desc') }}" />
</div>

<div
    class="mt-8 inline-flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-800 px-4 py-2 rounded-lg shadow-sm dark:bg-amber-950/30 dark:border-amber-500/30 dark:text-amber-400 dark:shadow-amber-900/20">
    <span class="relative flex h-3 w-3">
        <span
            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 dark:bg-amber-500 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500 dark:bg-amber-400"></span>
    </span>
    <p class="text-sm font-medium">
        <strong>{{ __('hero.demo_warning_title') }}:</strong> {{ __('hero.demo_warning_desc') }}
    </p>
</div>
