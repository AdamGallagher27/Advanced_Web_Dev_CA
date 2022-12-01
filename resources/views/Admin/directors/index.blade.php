<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __('Directors') }}
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

            {{-- used for debugging --}}
            {{-- {{ $directors }} --}}

            {{-- create button --}}
            <a href="{{ route('admin.directors.create') }}" class="btn-link mb-2 mt-5">create new director</a>

            @foreach ($directors as $director)
                <div class="my-6 p-6 bg-white border-b border-gray-200 mt-6 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{ $director->name }}
                    </h2>
                    <p>
                        {{ $director->bio }}
                    </p>
                    <div class="flex">
                        {{-- button for edit director --}}
                        <a href="{{ route('admin.directors.edit', $director) }}" class="btn-link mb-2 mt-5">edit</a>
                        <form action=" {{ route('admin.directors.destroy', $director) }}" method="POST">
                            {{-- delete method for form --}}
                            @method('delete')

                            {{-- requiered crsf token  --}}
                            @csrf

                            {{-- button for delete --}}
                            <button type="submit" class="btn btn-danger ml-4 mt-5"
                                onclick="return confirm('are you sure you want to delete')">Delete</button>
                        </form>
                    </div>

                    <span class="block mt-4 text-sm opacity-70">
                        {{ $director->created_at->diffForHumans() }}
                    </span>
                </div>
            @endforeach

        </div>
    </div>


</x-app-layout>
