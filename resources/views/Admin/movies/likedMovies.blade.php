<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __('Liked Movies') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse ($movies as $movie)
            <div class="my-6 p-6 bg-white border-b border-gray-200 mt-6 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    {{ $movie->title }}
                </h2>

                <p class="mt-2">
                    Description : {{ $movie->description }}
                </p>
                <p>
                    Budget : {{ $movie->budget }}
                </p>
                <p>
                    Box Office : {{ $movie->box_office }}
                </p>

                {{-- this if statement checks if their is an image saved in public folder --}}
                @if(file_exists(public_path('storage/images/' . $movie->image)))
                    {{-- and returns the image from the public folder for image src --}}
                    <img src="{{ asset('storage/images/' . $movie->image) }}" alt="Movie poster">
                @else
                    {{-- else use faker image url for image src --}}
                    <img src="{{ $movie->image }}" alt="Movie poster">
                @endif

            </div>

            @empty
                {{ "no movies yet" }}
            @endforelse

        </div>
    </div>


</x-app-layout>
