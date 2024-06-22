<script setup>
    import Like from '../icons/Like.vue';
    import Comment from '../icons/Comment.vue';
    import {
        ref
    } from 'vue';

    const posts = ref([{
            id: 1,
            post: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit',
            attachments: [
                'https://picsum.photos/seed/picsum/500',
            ],
            reactions: 40,
            comments: 50,
        },
        {
            id: 2,
            post: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit',
            attachments: [
                'https://picsum.photos/seed/picsum/500',
                'https://picsum.photos/seed/picsum/500',
                'https://picsum.photos/seed/picsum/500',
                'https://picsum.photos/seed/picsum/500',
            ],
            reactions: 8,
            comments: 0,
        },
        {
            id: 3,
            post: 'Lorem ipsum dolor sit, amet consectetur adipisicing elit',
            attachments: [],
            reactions: 12,
            comments: 8,
        },
        {
            id: 4,
            post: '',
            attachments: [
                'https://picsum.photos/seed/picsum/500',
            ],
            reactions: 23,
            comments: 44,
        }
    ])
</script>

<template>
    <div class="">
        <article class="bg-gray-200 p-5 mt-10 mb-3 rounded" v-for="post in posts" :key="post.id">
            <p v-if="post" class="my-4">
                {{ post . post }}
            </p>
            <div v-if="post.attachments.length > 0">
                <div v-if="post.attachments.length > 0">
                    <div v-if="post.attachments.length > 1" class="grid grid-cols-2 gap-1">
                        <div v-for="(attachment, index) in post.attachments.slice(0, post.attachments.length)" :key="index">
                            <img :src="attachment" alt="post" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div v-else>
                        <img :src="post.attachments[0]" alt="post" class="w-full">
                    </div>
                </div>
            </div>
                <div class="grid grid-cols-2 mt-2 py-3 rounded gap-1">
                    <div class="text-center bg-white py-2">
                        Likes ({{ post . reactions }})
                    </div>
                    <div class="text-center bg-white py-2">
                        Comment ({{ post . comments }})
                    </div>
                </div>
        </article>
    </div>
</template>
