@props(['role', 'title', 'description'])

<div class="group relative bg-slate-50 border border-slate-300 p-6 rounded-xl hover:border-indigo-500 hover:shadow-md transition-all duration-150">
    <form method="POST" action="/demo-login/{{ $role }}">
        @csrf
        <button type="submit" class="text-left w-full after:absolute after:inset-0 cursor-pointer focus:outline-none">
            <h3 class="font-bold text-lg group-hover:text-indigo-600 transition-all duration-150">{{ $title }}</h3>
            <p class="text-slate-600 text-sm">{{ $description }}</p>
        </button>
    </form>
</div>
