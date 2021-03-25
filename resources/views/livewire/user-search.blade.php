<div class="mt-2">
    <input placeholder="Search users" class="border-2 border-gray-100 dark:bg-gray-800 rounded-xl" type="search" wire:model="search" />
    @if ($results)
    <section class="fixed m-3 left-1/2">
        <div class="relative -left-1/2">
            @foreach ($results as $user)
            <a href="/user/{{ $user->id }}" class="flex items-center justify-between p-2 bg-gray-100 shadow-2xl w-60 rounded-xl">
                <span class="flex items-center justify-center">
                    <img class="w-8 h-8 p-1 m-1" src="{{ $user->image }}" alt="{{ $user->nickname }}'s profile picture">
                    <p>{{ $user->nickname }}</p>
                </span>
                <span class="text-sm">{{ $user->followers()->count() }} followers</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
