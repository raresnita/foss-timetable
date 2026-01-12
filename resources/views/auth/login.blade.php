<x-layout>
    <x-heading>Login</x-heading>

    <section class="flex justify-center mx-auto">
        <div class="p-8 bg-slate-50 rounded-xl border border-black/15 min-w-xl">
            <p class="text-lg">Enter your credentials to gain access to notifications and personal timetable</p>

            <form method="POST" action="/login">
                @csrf

                <x-forms.input
                    label="E-mail"
                    type="email"
                    name="email"
                    placeholder="john_doe@test.test"/>
                <x-forms.input
                    label="Password"
                    name="password"
                    type="password"/>

                <x-forms.button>Login</x-forms.button>
            </form>

            <h3>Don't have an account? <a href="/register" class="text-teal-600 hover:underline">Create one!</a></h3>
        </div>
    </section>
</x-layout>

