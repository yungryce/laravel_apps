<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form action="{{ route('contact.store') }}" method="post">
            @csrf
                <!-- Message-->
                <textarea
                    name="message"
                    placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />

                <x-primary-button class="mt-4">
                    {{ __('Submit') }}
                </x-primary-button>
        </form>
    </div>
</x-app-layout>


<!-- <form action="/contact" method="post">
    @csrf
    <input type="text" name="name" placeholder="Your Name">
    <input type="email" name="email" placeholder="Your Email">
    <textarea name="message" placeholder="Your Message"></textarea>
    <button type="submit">Submit</button>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


</form> -->
