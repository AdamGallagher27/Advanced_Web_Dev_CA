<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __("Movie") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- edit button sends movie to edit route (with movie variable)--}}
            <a href="{{ route('movies.edit', $movie) }}" class="btn-link btn-lg mb-2">Edit</a>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- testing to see if movie variable is passed in --}}
                {{-- {{ $movie }} --}}
                <h2 class="font-bold text-2xl">
                    {{ $movie->title }}
                </h2>
                {{-- image will have file location in future --}}
                <img src=" {{ $movie->image }} " alt="">
                <ul>
                    <li> Directed By : {{ $movie->director }}</li>
                    <li>Budget: {{ $movie->budget }}</li>
                    <li>Box Office : {{ $movie->box_office }}</li>
                </ul>
                <p class="mt-2">
                    Description : {{ $movie->description }}
                </p>
                {{-- using created_at instead of updated_at to show when it was posted first --}}
                <span class="block mt-4 text-sm opacity-70">{{ $movie->created_at->diffForHumans() }}</span>
                {{-- going to make this the user who posted this movie --}}
                <span class="block mt-4 text-sm opacity-70">Posted By : {{ $movie->user_id }}</span>
            </div>
        </div>
    </div>

</x-app-layout>