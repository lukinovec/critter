<div class="p-2 m-1 rounded-lg bg-gray-50">
    <span class="flex items-center justify-between space-x-2 text-xs">
        <span class="flex">
         <img class="w-3 h-3 m-1 rounded-full" src="{{ $comment->author->image }}" />
         <a class="my-auto" href="{{ 'user/' . $comment->author->id }}">
            {{ $comment->author->nickname }}
         </a>
        </span>
        @if (auth()->id() === $comment->author->id)
        <button class="text-red-900" wire:click="delete()">
            Delete
        </button>
        @endif
    </span>
    <div>
        {{ $comment->text }}
    </div>
</div>