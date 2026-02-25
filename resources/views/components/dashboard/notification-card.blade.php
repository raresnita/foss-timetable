@php
    use Illuminate\Support\Str;

       $notification = Auth::user()->notifications->first();
@endphp
@props(['count'])

<div {{$attributes->merge(['class'=>($count > 0 ? "bg-red-400" : "bg-slate-50")
." p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-indigo-600 transition-all duration-125"])}}>
    <div>
        <h2>{{$count === 0 ? "No new notifications" : ($count > 1 ? $count.' new notifications' : $count.' new notification' )}}</h2>
        @if($notification)
            <div class="notification-card">
                <strong>{{ $notification->data['professor_name'] }}</strong>

                <p>{{ Str::limit($notification->data['message'], 140, $end='...') }}</p>
                <small>{{ Carbon\Carbon::parse($notification->data['sent_at'])->diffForHumans() }}</small>
            </div>
        @endif

        <button command="show-modal" commandfor="dialog"
                class="rounded-md bg-slate-50/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-indigo-950/10 transition-all duration-150 cursor-pointer">
            Show notifications
        </button>

        <el-dialog>
            <dialog id="dialog" aria-labelledby="dialog-title"
                    class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                <el-dialog-backdrop
                    class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <el-dialog-panel
                        class="relative transform overflow-hidden rounded-lg bg-slate-50 text-left shadow-xl transition-all sm:my-8 sm:w-full">
                        <div class="bg-slate-50   px-4 pt-5 pb-4 sm:p-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 id="dialog-title" class="text-base font-semibold text-gray-900">
                                        Notifications</h3>
                                    <div class="mt-4">
                                        @foreach(Auth::user()->notifications as $notification)
                                            <div class="notification-card">
                                                <strong>{{ $notification->data['professor_name'] }}</strong>
                                                <p>{{ Str::limit($notification->data['message'], 140, $end='...') }}</p>
                                                <small>{{ Carbon\Carbon::parse($notification->data['sent_at'])->diffForHumans() }}</small>
                                            </div>
                                        @endforeach()
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-100 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" command="close" commandfor="dialog"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                Close
                            </button>
                        </div>
                    </el-dialog-panel>
                </div>
            </dialog>
        </el-dialog>

        {{--        @foreach(Auth::user()->notifications as $notification)--}}
        {{--            <div class="notification-card">--}}
        {{--                <strong>{{ $notification->data['professor_name'] }}</strong>--}}

        {{--                <p>{{ Str::limit($notification->data['message'], 140, $end='...') }}</p>--}}
        {{--                <small>{{ Carbon\Carbon::parse($notification->data['sent_at'])->diffForHumans() }}</small>--}}
        {{--            </div>--}}
        {{--        @endforeach()--}}
    </div>
</div>
