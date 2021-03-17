{{-- Listener pro new-comment --}}
<div class="flex flex-col w-64 px-2 pt-2 m-4 text-base shadow-lg bg-gray-50 rounded-xl">
    {{-- Tělo postu --}}
    <section class="bg-gray-50 rounded-xl">
        {{-- Autor --}}
        <div class="flex justify-between p-2 m-1 space-x-2 text-gray-700 bg-gray-100 border-b-2 border-gray-200 rounded-lg">
        <div class="flex justify-between flex-1">
            <span class="flex">
                <img class="w-10 h-10 m-1 rounded-full" alt="" src="{{ $item->author->image }}" />
                <a class="my-auto" href='{{ "user/" . $item->author->id }}'>
                    {{ $item->author->nickname }}
                </a>
            </span>
            {{-- <div x-text="post.created_at" class="flex-1 text-xs text-right text-gray-600"></div> --}}
            @if (auth()->id() === $item->author->id)
            <button class="text-red-900" wire:click="delete()">
                Delete
            </button>
            @endif
        </div>
    </div>
    <span class="p-2 m-1 rounded-lg">
        {{ $item->text }}
    </span>
    <div class="flex justify-between p-1 m-1 text-xs rounded-lg">
        {!! $this->render_like_section() !!}
    </div>
     </section>
     <section class="my-1 border-t-2 border-gray-200">
         <div class="overflow-auto max-h-60">
             @foreach ($item->comments as $comment)
             <livewire:comment key="{{ Str::random() }}" :comment="$comment">
             @endforeach
        </div>
         @auth
         <div class="z-20 text-right">
             <input class="p-1 m-2 text-left border-gray-200 rounded-lg" type="text" name="newComment" wire:model="text" placeholder="Your comment...">
             <a class="p-1 mx-2 text-xs text-right text-gray-600 rounded-lg cursor-pointer hover:bg-gray-200" wire:click="comment()">Comment</a>
         </div>
         @endauth
    </section>
    {{-- <pre>{{ $item->likes }}</pre> --}}
</div>