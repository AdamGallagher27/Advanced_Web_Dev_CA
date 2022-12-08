


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __("movies") }}
        </h2>
    </x-slot>

    <div class="py-12">
       
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- show success message for update / create --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green">
                    {{ session('success') }}
                </div>
            @endif

            {{-- buttons for admin controlls --}}
            <a href="{{ route('admin.movies.create') }}" class="btn-link btn-lg mb-2">+ New Movie</a>
            <a href="{{ route('admin.productions.index') }}" class="btn-link btn-lg mb-2">Production Companies</a>
            <a href="{{ route('admin.directors.index') }}" class="btn-link btn-lg mb-2">Directors</a>
            
            {{-- button to see liked movies --}}
            <a href="{{ route('admin.likedMovies') }}" class="btn-link mb-2 mt-5">favourite movies</a>
            @forelse ($movies as $movie)
                <div class="my-6 p-6 bg-white border-b border-gray-200 mt-6 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a>
                            
                    </h2>
                    <span class="mt-2">
                        {{ $movie->description }}
                    </span>
                    <span class="block mt-4 text-sm opacity-70">
                        {{ $movie->created_at->diffForHumans() }}
                    </span>
                </div>
                @empty
                <p>You have no movies yet.</p>
                @endforelse
                {{$movies->links()}}
        </div>
    </div>

    
</x-app-layout>