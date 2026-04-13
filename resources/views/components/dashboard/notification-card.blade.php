@props(['count'])

<div
    {{ $attributes->merge([
        'class' =>
            ($count > 0
                ? 'bg-red-400 border-red-300 dark:bg-red-950/40 dark:border-red-900/50 dark:ring-1 dark:ring-white/10'
                : 'bg-slate-50 dark:bg-slate-900 dark:border-slate-800 dark:ring-1 dark:ring-white/10') .
            ' p-5 rounded-2xl shadow border border-black/15 transition-all duration-125',
    ]) }}>

    <div class="flex flex-row items-center justify-between">
        <h2
            class="font-bold leading-none {{ $count > 0 ? 'text-red-950 dark:text-red-200' : 'text-slate-800 dark:text-slate-200' }}">
            {{ $count === 0 ? 'No new notifications' : ($count > 1 ? $count . ' new notifications' : $count . ' new notification') }}
        </h2>

        <button command="show-modal" commandfor="dialog"
            class="shrink-0 flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-bold shadow-sm transition-all cursor-pointer
                {{ $count > 0
                    ? 'bg-red-100 text-red-700 hover:bg-white dark:bg-red-900 dark:text-red-100 dark:hover:bg-red-800'
                    : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700' }}">
            Show notifications
        </button>
    </div>

    <el-dialog>
        <dialog id="dialog" aria-labelledby="dialog-title"
            class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-slate-950/50 dark:backdrop:bg-black/80">
            <el-dialog-backdrop class="fixed inset-0 transition-opacity"></el-dialog-backdrop>

            <div class="flex min-h-full items-center justify-center p-4">
                <el-dialog-panel
                    class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-900 text-left shadow-2xl transition-all 
                    w-full md:w-2xl border border-transparent dark:border-slate-800 ring-1 ring-black/5 dark:ring-white/10">

                    <div class="px-6 py-6 min-w-40">
                        <h3 id="dialog-title"
                            class="text-lg font-bold text-gray-900 dark:text-white border-b dark:border-slate-800 pb-3">
                            Notifications
                        </h3>

                        <div class="mt-4 space-y-4 max-h-[60vh] overflow-y-auto">
                            @forelse(Auth::user()->notifications as $notification)
                                <div
                                    class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-800">
                                    <div class="flex flex-col md:flex-row justify-between items-start mb-1">
                                        <span class="font-bold text-slate-900  dark:text-slate-100 text-sm">
                                            {{ $notification->data['professor_name'] }}
                                        </span>
                                        <span class="text-xs text-slate-500 italic">
                                            {{ Carbon\Carbon::parse($notification->data['sent_at'])->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                        {{ Str::limit($notification->data['message'], 140) }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-center py-4 text-slate-500 italic">Nothing to see here.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex justify-end">
                        <button type="button" command="close" commandfor="dialog"
                            class="cursor-pointer rounded-lg bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-900 dark:text-slate-200 shadow-sm dark:ring-1 dark:ring-white/10 ring-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-150">
                            Close
                        </button>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
</div>
