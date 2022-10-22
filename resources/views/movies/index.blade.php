


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __("movies") }}
        </h2>
    </x-slot>

    <div class="py-12">
       
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('movies.create') }}" class="btn-link btn-lg mb-2">+ New Movie</a>
            @forelse ($movies as $movie)
                <div class="my-6 p-6 bg-white border-b border-gray-200 mt-6 shadow-sm sm:rounded-lg">
                {{ $movie->title }}
                    
                </div>
                @empty
                <p>You have no movies yet.</p>
                @endforelse
                {{$movies->links()}}
        </div>
    </div>

    
</x-app-layout>