@extends('template/layout')
@section('content')
<div x-data="{ ...functions(), posts: [], user: [], newPostText: '', commentsHidden: false }" x-cloak x-init="fetchUser(); indexPosts()" class="flex flex-col items-center justify-center h-full p-8 mt-24 sm:mt-20">
    @auth
    <span class="z-20">
        <input class="border-gray-200 rounded-lg" type="text" name="crit" x-model="newPostText" placeholder="Your crit...">
        <button class="p-2 m-1 border border-gray-200 rounded-lg hover:bg-gray-100" x-on:click="createPost(newPostText)">Post</button>
    </span>
    @endauth
    <div class="z-30 flex-1 h-full crit-container">
        {{-- Všechny posty --}}
        <template x-for="post in posts" :key="post.id">
            {{-- Listener pro new-comment --}}
            <div x-on:new-comment="createComment($event.detail.text, post.id)" class="flex flex-col w-64 px-2 pt-2 m-4 text-base shadow-lg bg-gray-50 rounded-xl">
                {{-- Tělo postu --}}
                <section class="bg-gray-50 rounded-xl">
                    {{-- Autor --}}
                    <div class="flex justify-between p-2 m-1 space-x-2 text-gray-700 bg-gray-100 border-b-2 border-gray-200 rounded-lg">
                        <div class="flex justify-between flex-1">
                            <span class="flex">
                                <img class="w-10 h-10 m-1 rounded-full" alt="" :src="post.author.image" />
                                <a class="my-auto" :href="'/user/' + post.author.id" x-text="post.author.nickname"></a>
                            </span>
                            {{-- <div x-text="post.created_at" class="flex-1 text-xs text-right text-gray-600"></div> --}}
                            <button class="text-red-900" x-show="user.id === post.author.id" x-on:click="deletePost(post.id)">
                                Delete
                            </button>
                        </div>
                    </div>
                <span class="p-2 m-1 rounded-lg" x-text="post.text"></span>
                <div class="flex justify-between p-2 m-2 text-xs rounded-lg">
                    <div class="flex-1 mt-auto">
                            @auth
                            <button x-show="user.id !== post.author.id && user.post_likes.some(item => item.post_id === post.id)" x-on:click="unlikePost(post.id); post.likes = post.likes.filter(item => item.post_id !== post.id)">
                                Unlike
                            </button>

                            <button x-show="user.id !== post.author.id && !user.post_likes.some(item => item.post_id === post.id)" x-on:click="likePost(post.id); post.likes.push({profile_id: user.id, post_id: post.id})">
                                Like
                            </button>
                            @endauth
                            <span x-text="post.likes.length"></span>
                        </div>
                    </div>
                    </section>
                    <section class="my-2 border-t-2 border-gray-200">
                        <div class="overflow-auto max-h-60">
                            <template x-for="comment in post.comments" class="text-sm" :key="comment.id">
                                <div class="p-2 m-1 rounded-lg bg-gray-50">
                                    <span class="flex items-center justify-between space-x-2 text-xs">
                                        <span class="flex">
                                            <img class="w-3 h-3 m-1 rounded-full" :src="comment.author.image" />
                                            <a class="my-auto" :href="'/user/' + comment.author.id" x-text="comment.author.nickname"></a>
                                        </span>
                                        <button class="text-red-900" x-show="user.id === comment.author.id" x-on:click="deleteComment(comment.id)">
                                            Delete
                                        </button>
                                    </span>
                                    <div x-text="comment.text"></div>
                                </div>
                            </template>
                        </div>
                        @auth
                        <div x-data="{ newCommentText: '' }" class="z-20 text-right">
                            <input class="p-1 m-2 text-left border-gray-200 rounded-lg" type="text" name="newComment" x-model="newCommentText" placeholder="Your comment...">
                            <a class="p-1 mx-2 text-xs text-right text-gray-600 rounded-lg cursor-pointer hover:bg-gray-200" x-on:click="$dispatch('new-comment', { text: newCommentText }); newCommentText = ''">Comment</a>
                        </div>
                        @endauth
                    </section>
                    </div>
            </template>
    </div>


</div>
@endsection

<script>
    function functions() {
        return {
            fetchUser() {
                console.log("Fetching user...")
                axios.get("/get-user").then(res => {this.user = res.data; ; console.log("User fetched! - " + res.data)});
            },

            indexPosts() {
                console.log("Getting posts...")
                axios.get("/get-posts").then(res => {this.posts = res.data; console.log("Posts got!")});
            },

            createPost(text) {
                if(text.length > 2) {
                    axios.post("/new-post", { crit: text }).then(res => this.indexPosts());
                }
                this.newPostText = "";
            },

            deletePost(id) {
                axios.post("/delete-post", { post_id: id }).then(res => this.indexPosts());
            },

            createComment(text, id) {
                if(text.length > 2) {
                    axios.post("/new-comment", { post_id: id, text: text }).then(res => this.indexPosts());
                }
            },

            deleteComment(id) {
                axios.post("/delete-comment", { comment_id: id }).then(res => this.indexPosts());
            },

            likePost(id) {
                axios.post('/post-like', {post_id: id}).then(res => this.fetchUser());
            },

            unlikePost(id) {
                axios.post('/post-unlike', {post_id: id}).then(res => this.fetchUser());
            },
        }
    }
</script>