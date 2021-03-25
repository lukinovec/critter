<div class="p-2 m-1 my-2 border-2 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-transparent dark:border-gray-700">
    <span class="flex items-center justify-between space-x-2 text-xs">
        <a class="flex items-center my-auto" href="{{ 'user/' . $comment->author->id }}">
            <img class="w-3 h-3 m-1 rounded-full" src="{{ $comment->author->image }}" />
               {{ $comment->author->nickname }}
         </a>
        @if (auth()->id() === $comment->author->id)
        <button class="text-red-800" wire:click="delete()">
            Delete Comment
        </button>
        @endif
    </span>
    <div>
        {{ $comment->text }}
    </div>
</div>