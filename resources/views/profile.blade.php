@extends('template/layout')
@section('content')
<div class="flex flex-col items-center w-full h-full mt-20 text-lg text-center">
    <section class="flex flex-col items-center justify-center w-40 h-40 p-4 bg-gray-100 rounded-full dark:bg-gray-900">
        <img class="w-24 h-24 rounded-full " src="{{ $profile->image }}" alt="profile image">
        <span>{{ $profile->nickname }}</span>
    </section>

    <section class="z-30 flex-1 h-full crit-container">
        {{-- Všechny posty --}}
        @foreach($profile->posts as $post)
        <div class="flex flex-col w-64 px-2 pt-2 m-4 text-base shadow-lg bg-gray-50 rounded-xl">
            <div class="flex p-2 space-x-2 text-gray-700 border-b-2 border-gray-300">
                <img class="w-10 h-10 rounded-full" src="{{ $post->author->image }}"  alt="">
                <a class="my-auto" href="{{ url('/user/' . $post->author->id) }}">{{ $post->author->nickname }}</a>
            </div>
            <span class="p-2">{{ $post->text }}</span>
            <div class="flex justify-between text-xs">
                <div class="flex-1 mt-auto">
                    Like
                </div>
                <div class="flex-1 text-right text-gray-600">
                    {{ $post->created_at }}
                </div>
            </div>
        </div>
    @endforeach
    </section>
    @if ($isOwner)
    @else
    @endif
</div>
@endsection

<script>
</script>