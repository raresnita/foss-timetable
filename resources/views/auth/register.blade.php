<x-layout>
    <x-heading>Register</x-heading>

    <section class="flex justify-center mx-auto">
        <div class="p-8 bg-slate-50 rounded-xl border border-black/15 min-w-xl">
            <p class="text-lg">Enter your credentials to create an account</p>

            <form method="POST" action="/register">
                @csrf

                <x-forms.input
                    label="Full name"
                    type="name"
                    name="name"
                    placeholder="John Doe"/>
                <x-forms.input
                    label="E-mail"
                    type="email"
                    name="email"
                    placeholder="john_doe@test.test"/>
                <x-forms.input
                    label="Password"
                    name="password"
                    type="password"/>
                <x-forms.input
                    label="Password confirmation"
                    name="password_confirmation"
                    type="password"/>

                <x-forms.button>Register</x-forms.button>
            </form>

            <h3>Already have an account? <a href="/login" class="text-teal-600 hover:underline">Log in!</a></h3>
        </div>
    </section>
</x-layout>

