<x-app-layout>

    <x-slot name="header">
        <h2 class="font-medium text-sm text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Please, reach out ...') }}
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <div class="w-full mt-12 sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                    <!-- Message-->
                    <textarea
                        name="message"
                        placeholder="{{ __('What\'s on your mind, :username?', ['username' => auth()->user()->username]) }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />

                    <x-primary-button class="mt-4">
                        {{ __('Submit') }}
                    </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
