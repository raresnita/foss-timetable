<x-layout>
    <x-heading>Register</x-heading>

    <section class="flex justify-center">
        <div
            class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-slate-50 rounded-xl border-gray-200 border shadow-2xl">
            <h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                Enter your credentials to create an account
            </h2>

            <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
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
            </div>
            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Already have an account? <a href="/login" class="text-indigo-600 hover:underline">Log in!</a>
            </p>
        </div>
    </section>
</x-layout>

