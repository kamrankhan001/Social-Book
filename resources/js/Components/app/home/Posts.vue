<script setup>
import { ref } from "vue";

const posts = ref([
    {
        id: 1,
        post: "Lorem ipsum dolor sit, amet consectetur adipisicing elit",
        attachments: ["https://picsum.photos/seed/picsum/500"],
        reactions: 40,
        comments: 50,
    },
    {
        id: 2,
        post: "Lorem ipsum dolor sit, amet consectetur adipisicing elit",
        attachments: [
            "https://picsum.photos/seed/picsum/500",
            "https://picsum.photos/seed/picsum/500",
            "https://picsum.photos/seed/picsum/500",
            "https://picsum.photos/seed/picsum/500",
        ],
        reactions: 8,
        comments: 0,
    },
    {
        id: 3,
        post: "Lorem ipsum dolor sit, amet consectetur adipisicing elit",
        attachments: [],
        reactions: 12,
        comments: 8,
    },
    {
        id: 4,
        post: "",
        attachments: ["https://picsum.photos/seed/picsum/500"],
        reactions: 23,
        comments: 44,
    },
]);
</script>

<template>
    <div>
        <div
         class="mt-10"
            v-for="post in posts"
            :key="post.id"
        >
            <div class="flex items-center gap-2 bg-white p-2 rounded">
                <img
                    src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="user profile"
                    class="w-12 h-12 rounded-full"
                />
                <p class="text-xl">
                    John Doe
                    <time datetime="jan, 12 2024" class="block text-xs -mt-1"
                        >jan, 12 2024</time
                    >
                </p>
            </div>
            <article class="bg-gray-200 p-2 mb-3 rounded">
                <p v-if="post" class="my-2">
                    {{ post.post }}
                </p>
                <div v-if="post.attachments.length > 0">
                    <div v-if="post.attachments.length > 0">
                        <div
                            v-if="post.attachments.length > 1"
                            class="grid grid-cols-2 gap-1"
                        >
                            <div
                                v-for="(
                                    attachment, index
                                ) in post.attachments.slice(
                                    0,
                                    post.attachments.length
                                )"
                                :key="index"
                            >
                                <img
                                    :src="attachment"
                                    alt="post"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                        <div v-else>
                            <img
                                :src="post.attachments[0]"
                                alt="post"
                                class="w-full"
                            />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 mt-2 py-3 rounded gap-1">
                    <div class="text-center bg-white py-2">
                        Likes ({{ post.reactions }})
                    </div>
                    <div class="text-center bg-white py-2">
                        Comment ({{ post.comments }})
                    </div>
                </div>
            </article>
        </div>
    </div>
</template>
