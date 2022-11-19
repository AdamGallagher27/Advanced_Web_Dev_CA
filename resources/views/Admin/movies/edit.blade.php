<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                {{-- variable for testing if $movie is coming through --}}
                {{-- {{ $movie }} --}}

                {{-- sends updated movie to update function --}}
                <form action="{{ route('admin.movies.update', $movie), 'movie' }} " method="POST">

                    {{-- every form needs this to prevent attacks --}}
                    @csrf

                    {{-- form method cant have a put method --}}
                    {{-- this lets us have a put method --}}
                    @method('put')

                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="title" class="w-full"
                        placeholder="Title" :value="@old('title', $movie->title)">
                    </x-text-input>

                    @error('director')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="director" class="w-full " placeholder="Director"
                        :value="@old('director', $movie->director)"></x-text-input>

                    @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-textarea name="description" rows="10" class="w-full mt-6" placeholder="Description..."
                        :value="@old('description', $movie->description)"></x-textarea>

                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-textarea name="image" rows="10" class="w-full mt-6" placeholder="image..."
                        :value="@old('image', $movie->image)"></x-textarea>

                    @error('budget')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="budget" class="w-full " placeholder="budget" :value="@old('budget', $movie->budget)">
                    </x-text-input>

                    @error('box_office')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="box_office" class="w-full " placeholder="box office"
                        :value="@old('box_office', $movie->box_office)"></x-text-input>

                    <x-primary-button name="submit" type="Submit" class="mt-6">Save Movie</x-primary-button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
