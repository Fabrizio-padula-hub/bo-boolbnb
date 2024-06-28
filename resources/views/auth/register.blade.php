<x-guest-layout>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                 autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Lastname -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Cognome')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                autocomplete="family-name" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                 autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Date of birth -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Data di nascita')" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                :value="old('date_of_birth')" autocomplete="bday" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Conferma Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sei già registrato?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registrati') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
