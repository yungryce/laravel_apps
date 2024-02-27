<x-guest-layout>
    <form action="{{ route('contact.store') }}" method="post">
        @csrf

        <!--First Name  -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name  -->
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Message-->
        <div class="mt-4">
            <x-input-label for="message" :value="__('Message')" />
            <x-textarea id="message" class="block mt-1 w-full" type="textarea" name="message" :value="old('message')" required autocomplete="message" />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4">
            {{ __('Submit') }}
        </x-primary-button>
    </form>
</x-guest-layout>