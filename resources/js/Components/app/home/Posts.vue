<script setup>
import { HandThumbUpIcon, ChatBubbleBottomCenterIcon } from '@heroicons/vue/24/outline';

defineProps({
    posts: Array,
})
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
                    :src="post.user.avater_image || '/assets/imgs/avater.jpg'"
                    alt="user profile"
                    class="w-12 h-12 rounded-full"
                />
                <p class="text-xl">
                    {{ post.user.name  }}
                    <time datetime="jan, 12 2024" class="block text-xs -mt-1"
                        >{{post.created_at }}</time
                    >
                </p>
            </div>
            <article class="bg-gray-200 p-2 mb-3 rounded">
                <p class="my-2">
                    {{post.body }}
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
                    <button class="flex justify-center items-center gap-1 bg-white py-2">
                        <HandThumbUpIcon class="size-6"/> (10)
                    </button>
                    <button class="flex justify-center items-center gap-1 bg-white py-2">
                        <ChatBubbleBottomCenterIcon class="size-6"/> (5)
                    </button>
                </div>
            </article>
        </div>
    </div>
</template>
