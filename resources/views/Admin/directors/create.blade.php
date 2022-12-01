<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.directors.store'), 'director'  }} " method="POST">

                    {{-- every form needs this to prevent attacks --}}
                    @csrf

                    {{-- input for director name --}}
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="name" class="w-full " placeholder="Name" :value="@old('name', $director->name)"></x-text-input>

                    {{-- input for director bio --}}
                    @error('bio')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <x-text-input type="text" name="bio" class="w-full mt-4" placeholder="Biography" :value="@old('bio', $director->bio)"></x-text-input>


                    <x-primary-button name="submit" type="Submit" class="mt-6">Save Directors</x-primary-button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}"> 
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>