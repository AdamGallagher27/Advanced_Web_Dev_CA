




<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- variable for testing if $movie is coming through --}}
                {{ $movie }}

                {{-- sends updated movie to update function --}}
                <form action="{{ route('movies.update', $movie), 'movie'  }} " method="POST">

                    {{-- every form needs this to prevent attacks --}}
                    @csrf

                    {{-- form method cant have a put method --}}
                    {{-- this lets us have a put method --}}
                    @method("put")

                    <x-text-input type="text" name="title" class="w-full " placeholder="Title" value="{{ $movie->title }}"></x-text-input>
                    <x-text-input type="text" name="director" class="w-full " placeholder="Director" value="{{ $movie->director }}"></x-text-input>
                    <x-textarea name="description" rows="10" class="w-full mt-6" placeholder="Description..." value="{{ $movie->description }}"></x-textarea>

                    {{-- image is a string right now will fix this later --}}
                    <x-textarea name="image" rows="10" class="w-full mt-6" placeholder="image..." value="{{ $movie->image }}"></x-textarea>
                    <x-text-input type="text" name="budget" class="w-full " placeholder="budget" value="{{ $movie->budget }}"></x-text-input>
                    <x-text-input type="text" name="box_office" class="w-full " placeholder="box office" value="{{ $movie->box_office }}"></x-text-input>

                    <x-primary-button name="submit" type="Submit" class="mt-6">Save Movie</x-primary-button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}"> 
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>
