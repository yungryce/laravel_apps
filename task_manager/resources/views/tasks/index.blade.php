<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <x-slot name="header">
            <h2 class="font-medium text-sm text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Have a new task 🗒️?') }}
            </h2>
        </x-slot>

        <x-alert>
            {{ session('success') }}
        </x-alert>

        <div class="w-full mt-12 sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mt-2">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus autocomplete="title" task="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description" placeholder="{{ __('What is your goal today, :username?', ['username' => auth()->user()->name]) }}" 
class="block w-full {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm" autofocus autocomplete="title"></textarea>

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y bg-gray-300">
                @foreach ($tasks as $task)
                    <hr>
                    <div class="p-6 flex space-x-2">

                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $task->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $task->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($task->created_at->eq($task->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if ($task->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">

                                            <form method="POST" action="{{ route('tasks.update', $task) }}">
                                                @csrf
                                                @method('patch')
                                                <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();" >
                                                    <input type="hidden" name="status" value="{{ !$task->status }}">
                                                    {{ $task->status ? 'Task not completed?' : 'Done?' }}
                                                </x-dropdown-link>
                                            </form>

                                            <x-dropdown-link :href="route('tasks.edit', $task)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>

                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>

                                    </x-dropdown>
                                @endif
                            </div>
                            <div class="">
                                <div class="flex gap-4 items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                    </svg>
                                    <h2 class="text-lg text-center underline font-black">{{ $task->title }}</h2>
                                </div>
                                <p class="mt-3">{{ $task->description }}</p>
                                <p class="text-sm text-center">{{ $task->status ? 'Completed 👍' : 'In Progress ...' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($tasks->hasPages())
                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>





