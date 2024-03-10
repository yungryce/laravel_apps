<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    
        <x-slot name="header">
            <h2 class="font-medium text-sm text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit your tasks') }}
        </x-slot>

        <div class="w-full mt-12 sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">


            <form action="{{ route('tasks.update', $task) }}" method="post">
                @csrf
                @method('patch')

                <div class="mt-2">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title', $task->title) }}" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4 space-x-2">
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                    <a href="{{ route('tasks.index') }}">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
