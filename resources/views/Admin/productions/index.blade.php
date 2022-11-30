



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading tight">
            {{ __("production companies") }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.productions.create') }}" class="btn-link btn-lg mb-2">+ New Production Company</a>
            @foreach ($productions as $prod)
            <div class="my-6 p-6 bg-white border-b border-gray-200 mt-6 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    {{ $prod->title }}                        
                </h2>
                <span class="block mt-4 text-sm opacity-70">
                    {{ $prod->created_at->diffForHumans() }}
                </span>
            </div>
            @endforeach
            
        </div>
    </div>

    
</x-app-layout>