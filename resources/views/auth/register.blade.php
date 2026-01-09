<x-layout>
    <x-heading>Register</x-heading>
    <div>
        <p>Enter your credentials to create an account</p>

        <form method="POST" action="/register">
            @csrf

            <x-forms.input label="Full name" type="name" name="name" placeholder="John Doe" />
            <x-forms.input label="E-mail" type="email" name="email" placeholder="john_doe@test.test" />
            <x-forms.input label="Password" name="password" type="password" />
            <x-forms.input label="Password confirmation" name="password_confirmation" type="password" />

            <x-forms.button>Register</x-forms.button>
        </form>
    </div>
</x-layout>

