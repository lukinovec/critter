@extends('template/layout')
@section('content')
<div class="flex flex-col items-center justify-center h-screen p-8">
    @auth
    <form method="POST" action="/post-crit">
        @csrf
        <label for="crit">Post your own crit</label>
        <input type="text" name="crit" placeholder="Your crit...">
        <button type="submit">Post</button>
    </form>
    @endauth
    <div class="flex-1 crit-container">
        @foreach($posts as $post)
        <div class="flex flex-col w-64 p-4 m-4 text-base bg-gray-100 shadow-lg rounded-xl">
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
    </div>

</div>
    @endsection