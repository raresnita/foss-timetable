@props(['id', 'title'])

<el-dialog>
    <dialog id="{{ $id }}" aria-labelledby="{{ $id }}-title"
        {{ $attributes->merge(['class' => 'fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-slate-950/50 dark:backdrop:bg-black/80 transition-all duration-150']) }}>

        <el-dialog-backdrop class="fixed inset-0 transition-opacity"></el-dialog-backdrop>

        <div class="flex min-h-full items-center justify-center p-4">
            <el-dialog-panel
                class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:w-full sm:max-w-lg border border-transparent dark:border-slate-800 ring-1 ring-black/5 dark:ring-white/10">

                <div class="px-6 py-6">
                    <h3 id="{{ $id }}-title"
                        class="text-lg font-bold text-gray-900 dark:text-white border-b dark:border-slate-800 pb-3">
                        {{ $title }}
                    </h3>

                    <div class="mt-4">
                        {{ $slot }}
                    </div>
                </div>

                @if (isset($footer))
                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">
                        {{ $footer }}
                    </div>
                @endif
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>
