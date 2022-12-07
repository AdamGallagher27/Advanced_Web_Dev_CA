{{-- @php
    dd($_GET);
@endphp --}}


<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('reviewer.reviews.store'), 'review'}} " method="POST">

                    {{-- every form needs this to prevent attacks --}}
                    @csrf

                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="title" class="w-full " placeholder="Title" :value="@old('title', $review->title)"></x-text-input>

                    @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="description" class=" mt-3 w-full " placeholder="Description" 
                    :value="@old('description', $review->description)"></x-text-input>

                    @error('rating')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="rating" class=" mt-3 w-full " placeholder="rating" 
                    :value="@old('rating', $review->rating)"></x-text-input>
                    {{-- movie id input --}}
                    <input type="hidden" name="movie_id" value="{{ $movie_id }}"> 

                    <x-primary-button name="submit" type="Submit" class="mt-6">Save Production</x-primary-button>

                    <input type="hidden" name="_token" value="{{ Session::token() }}"> 
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>