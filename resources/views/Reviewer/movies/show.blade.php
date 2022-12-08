@livewireStyles

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __("Movie") }}
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

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- testing to see if movie variable is passed in --}}
                {{-- {{ $movie }} --}}
                <h2 class="font-bold text-2xl">
                    {{ $movie->title }}
                </h2>



                {{-- this adds the image to show view --}}
                {{--
                    faker uses imageUrl() in seeder so images are stored in db as links to images
                    if a user creates image it is saved in public folder
                    the images being saved in two ways causes problems when loading images
                    as some images are file paths when others are Urls.

                    this is my work around...
                --}}

                {{-- this if statement checks if their is an image saved in public folder --}}
                @if(file_exists(public_path('storage/images/' . $movie->image)))
                    {{-- and returns the image from the public folder for image src --}}
                    <img src="{{ asset('storage/images/' . $movie->image) }}" alt="Movie poster">
                @else
                    {{-- else use faker image url for image src --}}
                    <img src="{{ $movie->image }}" alt="Movie poster">
                @endif
                
                <ul>
                    <ul>
                        <li>Directed By :
                            <table>
                                <tr>
                                    @foreach ($movie->directors as $director)
                                        {{ $director->name }}                            
                                    @endforeach
                                </tr>
                            </table>
                        </li>
                        <li>Production Company : {{ $production->title }}</li>
                        <li>Budget: {{ $movie->budget }}</li>
                        <li>Box Office : {{ $movie->box_office }}</li>
                    </ul>
                </ul>
                <p class="mt-2">
                    Description : {{ $movie->description }}
                </p>
                {{-- using created_at instead of updated_at to show when it was posted first --}}
                <span class="block mt-4 text-sm opacity-70">{{ $movie->created_at->diffForHumans() }}</span>
                {{-- going to make this the user who posted this movie --}}
                <span class="block mt-4 text-sm opacity-70">Posted By : {{ $user->name }}</span>

                {{-- live wire component for the like button --}}
                <livewire:like-button :movie="$movie" :currentUser="$currentUser"  /> 
            </div>

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    reviews
                </h2>
                <a href="{{ route('reviewer.reviews.create', ['movie_id' => $movie->id] ), }}"class="btn-link mb-2">Write A Review</a> 

                {{-- post every review for this movie --}}
                @foreach ($reviews as $review)
                    <div class="border border-gray-200 mt-2 mb-2 p-2">
                        <h4>{{ $review->title }}</h4>
                        <p>Description: {{ $review->description }}</p>
                        <p>Rating: {{ $review->rating }}</p>    
                        
                        {{-- update button --}}
                        <a href="{{ route('reviewer.reviews.edit', $review ), }}"class="btn-link mb-2 mt-3">Update Review</a> 
                        
                        {{-- delete button --}}
                        <form action=" {{ route('reviewer.reviews.destroy', $review) }}" method="POST">
                            {{-- delete method for form --}}
                            @method('delete')

                            {{-- requiered crsf token  --}}
                            @csrf

                            {{-- button for delete --}}
                            <button type="submit" class="btn btn-danger mt-2"
                                onclick="return confirm('are you sure you want to delete')">Delete Review</button>
                        </form>

                        {{-- display the user who reviewed it --}}
                        <span class="block mt-4 text-sm opacity-70">Posted By : 
                            @foreach ($reviewers as $reviewer)    
                                @if ($reviewer->id == $review->user_id)
                                    {{ $reviewer->name }}
                                @endif
                            @endforeach
                        </span>          
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    @livewireScripts
</x-app-layout>