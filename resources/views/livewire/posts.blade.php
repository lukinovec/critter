<div class="flex flex-col items-center justify-center h-full p-8 mt-16">
    @auth
    <span class="z-20 text-center">
        <span class="p-2 m-2 text-gray-500">
            What's on your mind?
        </span>
        <div class="flex p-2 m-2">
            <input class="w-3/4 border-gray-200 rounded-lg" type="text" name="crit" wire:model="newPostText" placeholder="Your crit...">
            <button class="p-2 m-1 border border-gray-200 rounded-lg hover:bg-gray-100" wire:click="createPost()">Post</button>
        </div>
    </span>
    @endauth
    <div class="z-30 flex-1 h-full crit-container">
        {{-- Všechny posty --}}
        @foreach($posts as $post)
            <livewire:post :post="$post" key="{{ Str::random() }}">
        @endforeach
    </div>


</div>