<div class="flex-1 mt-auto">
    @auth
    @if (auth()->id() !== $item->author->id)
        @if (auth()->user()->profile->likes->contains("parent_id", $item->id) && auth()->user()->profile->likes->contains("profile_id", auth()->id()))
        <button wire:click="unlike()">
            Unlike
        </button>
        @else
        <button wire:click="like()">
            Like
        </button>
        @endif
    @endif
    @endauth
    <span>{{ $item->likes->count() }}</span>
</div>