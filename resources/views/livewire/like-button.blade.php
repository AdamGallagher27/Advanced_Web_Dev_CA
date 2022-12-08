<div>

    {{-- if the post has not been liked display like button --}}
    @if (!self::hasLiked($movie->id, $currentUser->id))
        <button wire:click="likeDislike({{ $movie->id }}, {{ $currentUser->id }})" class="btn-link mb-2 mt-3">Like Button</button>
    
    {{-- else display dislike button --}}
    @else
        <button wire:click="likeDislike({{ $movie->id }}, {{ $currentUser->id }})" class="btn-link btn-danger mb-2 mt-3">Dislike Button</button>
    @endif
    
</div>
