{{-- Listener pro new-comment --}}
<div class="flex flex-col p-3 m-4 text-base shadow-sm w-96 bg-gray-50 dark:bg-transparent rounded-xl">
    {{-- Tělo postu --}}
    <section class="p-2 border-2 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 rounded-xl">
        {{-- Autor --}}
        <div class="flex justify-between p-1 space-x-2 text-gray-700 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">
            <div class="flex justify-between flex-1">
                <a href='{{ "user/" . $item->author->id }}' class="flex">
                    <img class="w-8 h-8 m-1 rounded-full" alt="" src="{{ $item->author->image }}" />
                    <span class="my-auto">
                        {{ $item->author->nickname }}
                    </span>
                </a>
                {{-- <div x-text="post.created_at" class="flex-1 text-xs text-right text-gray-600"></div> --}}
                @if (auth()->id() === $item->author->id)
                <button class="text-sm text-red-800" wire:click="delete()">
                    Delete Post
                </button>
                @endif
            </div>
        </div>
    <span class="p-2 m-1 rounded-lg">
        {{ $item->text }}
    </span>
    <img src="{{ asset($item->image) }}" alt="">
    <div class="flex justify-between p-1 m-1 text-xs rounded-lg">
        {!! $this->render_like_section() !!}
    </div>
     </section>
     <section class='my-1 {{ $item->comments->isNotEmpty() ? "border-t-2 border-gray-200 dark:border-gray-800" : ""}}'>
         <div class="overflow-auto max-h-60">
             @foreach ($item->comments as $comment)
             <livewire:comment key="{{ Str::random() }}" :comment="$comment">
             @endforeach
        </div>
         @auth
         <div class="z-20 text-right">
             <input class="w-full p-2 my-1 text-left border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700" type="text" name="new_comment" wire:model.debounce="comment_text" placeholder="Your comment...">
             <a class="p-1 mx-2 text-xs text-right text-gray-600 rounded-lg cursor-pointer dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700" wire:click="comment()">Comment</a>
         </div>
         @endauth
    </section>
    {{-- <pre>{{ $item->likes }}</pre> --}}
</div>