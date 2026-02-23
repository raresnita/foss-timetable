@props(['count'])

<div {{$attributes->merge(['class'=>($count > 0 ? "bg-red-400" : "bg-slate-50")
." p-4 rounded-xl shadow-sm border border-black/15 hover:shadow-md hover:border-teal-600 transition-all duration-125"])}}>
    <div>
        <h2>@choice('No new notifications|:count notification|:count notifications', $count)</h2>
        @foreach(Auth::user()->notifications as $notification)
            <div class="notification-card">
                <strong>{{ $notification->data['professor_name'] }}</strong>
                for group
                <strong>{{ $notification->data['group_name'] }}</strong>:
                <p>{{ $notification->data['message'] }}</p>
                <small>{{ Carbon\Carbon::parse($notification->data['sent_at'])->diffForHumans() }}</small>
            </div>
        @endforeach()
    </div>
</div>
