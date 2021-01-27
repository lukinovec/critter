@extends('template/layout')
@section('content')
<div x-data="{ ...functions(), posts: [], user: [], newPostText: '', commentsHidden: false }" x-cloak x-init="fetchUser(); indexPosts()" class="flex flex-col items-center justify-center h-full p-8">
    @auth
    <span class="sticky z-20 top-3">
        <input class="border-gray-200 rounded-lg" type="text" name="crit" x-model="newPostText" placeholder="Your crit...">
        <button class="p-2 m-1 border border-gray-200 rounded-lg hover:bg-gray-100" x-on:click="createPost(newPostText)">Post</button>
    </span>
    @endauth
    <div class="z-30 flex-1 crit-container">
        <template x-for="post in posts" :key="post.id">
            <div class="flex flex-col w-64 p-4 m-4 text-base shadow-lg bg-gray-50 rounded-xl">
                <section class="bg-gray-100 rounded-xl">
                    <div class="flex justify-between p-2 m-1 space-x-2 text-gray-700 bg-gray-100 border-b-2 border-gray-200 rounded-lg">
                        <div class="flex justify-between flex-1">
                            <img class="w-10 h-10 m-1 rounded-full" alt="" :src="post.author.image" />
                            <a class="my-auto" :href="'/user/' + post.author.id" x-text="post.author.nickname"></a>
                            <div x-text="post.created_at" class="flex-1 text-xs text-right text-gray-600"></div>
                        </div>
                        <button x-show="user === post.author" x-on:click="deletePost(post.id)">
                        Delete
                    </button>
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
                        <div class="flex-1 text-right text-gray-600 cursor-pointer" x-on:click="createComment = !createComment">Comment</div>
                    </div>
                    </section>
                        <section class="my-2">
                            <template x-for="comment in post.comments" class="text-sm" :key="comment.id">
                            <div class="p-2 m-1 bg-gray-100 rounded-lg">
                                <span class="flex items-center space-x-2 text-xs">
                                    <img class="w-3 h-3 m-1 rounded-full" :src="comment.author.image" />
                                    <a class="my-auto" :href="'/user/' + comment.author.id" x-text="comment.author.nickname"></a>
                                </span>
                                <div x-text="comment.text"></div>
                            </div>
                        </template>
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
                axios.post("/new-post", { crit: text }).then(res => this.indexPosts());
                this.newPostText = "";
            },

            deletePost(id) {
                axios.post("/delete-post", { post_id: id }).then(res => this.indexPosts());
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