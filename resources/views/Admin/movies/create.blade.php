<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.movies.store'), 'movie'  }} " method="POST" enctype="multipart/form-data">

                    {{-- every form needs this to prevent attacks --}}
                    @csrf

                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="title" class="w-full " placeholder="Title"></x-text-input>

                    @error('director')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="director" class="w-full " placeholder="Director"></x-text-input>

                    @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-textarea name="description" rows="10" class="w-full" placeholder="Description..."></x-textarea>

                    @error('budget')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="budget" class="w-full" placeholder="budget"></x-text-input>

                    @error('box_office')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="box_office" class="w-full " placeholder="box office"></x-text-input>


                    {{-- productions drop down --}}
                    <select class="mt-2" name="productions" id="productions">
                        @foreach ($productions as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->title }}</option>
                        @endforeach
                    </select>


                    {{-- select image --}}
                    <p class="mt-6">Select Image</p>
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-file-input type="file" placeholder="Image" name="image" class="w-full mt-6" field="image"></x-file-input>
                    <x-primary-button name="submit" type="Submit" class="mt-6">Save Movie</x-primary-button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}"> 
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>