<x-layout>
    <x-heading>Login</x-heading>
    <div>
        <p>Enter your credentials to see notifications from professors and future classes</p>

        <form method="POST" action="/login">
            @csrf

            <x-forms.input label="E-mail" type="email" name="email" placeholder="john_doe@test.test" />
            <x-forms.input label="Password" name="password" type="password" />

            <x-forms.button>Login</x-forms.button>
        </form>

        <h3>Don't have an account? <a href="/register">Create one!</a></h3>
    </div>
</x-layout>

