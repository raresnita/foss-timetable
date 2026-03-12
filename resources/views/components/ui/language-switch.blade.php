<div class="flex items-center gap-4 px-4 py-2 bg-slate-100 dark:bg-slate-900 rounded-lg w-fit">
    <a href="/lang/en"
        class="text-xs font-bold transition-colors {{ App::isLocale('en') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 hover:text-slate-600' }}">
        EN
    </a>
    <span class="text-slate-300 dark:text-slate-700">|</span>
    <a href="/lang/ro"
        class="text-xs font-bold transition-colors {{ App::isLocale('ro') ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 hover:text-slate-600' }}">
        RO
    </a>
</div>
