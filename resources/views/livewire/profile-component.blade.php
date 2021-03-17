
<div class="flex flex-col items-center w-full h-full mt-20 text-lg">
    <section class="flex flex-col items-center justify-center p-3 text-center bg-gray-100 rounded-full w-28 h-2w-28">
        <img class="w-16 h-16 rounded-full " src="{{ $profile->image }}" alt="profile image">
        <span>{{ $profile->nickname }}</span>
    </section>

    <section class="z-30 flex-1 h-full crit-container">
        {{-- Všechny posty --}}
        @foreach($profile->posts as $post)
        <livewire:post :post='$post' key="{{ Str::random() }}">
        @endforeach
    </section>
</div>