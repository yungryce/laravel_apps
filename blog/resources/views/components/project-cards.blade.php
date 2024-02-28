<div class="w-full flex flex-col px-4 space-y-4 md:w-1/2 lg:w-1/4 justify-center items-center">
    <h3 class="text-xl font-semibold mb-2 underline decoration-dotted mt-6">{{ $title }}</h3>
    <a href="{{ $link }}" class="group">
        <img src="{{ $image }}" alt="{{ $alt }}" class="rounded-lg h-64 w-64 transition duration-500 transform group-hover:scale-110 group-hover:shadow-md group-hover:shadow-red-900">
    </a>
    <a href="{{ $github }}" class="text-lg hover:underline hover:text-blue-400 font-bold px-2 shadow shadow-md shadow-blue-400">GitHub</a>
</div>