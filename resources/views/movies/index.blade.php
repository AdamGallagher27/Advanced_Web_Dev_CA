


<x-app-layout>
    @forelse ($movies as $movie)
                <div class="my-6 p-6 bg-white border-b border-gray-200 mt-6 shadow-sm sm:rounded-lg">
                   {{ $movie->title }}
                    
                </div>
            @empty
            <p>You have no movies yet.</p>
            @endforelse
            {{$movies->links()}}
</x-app-layout>