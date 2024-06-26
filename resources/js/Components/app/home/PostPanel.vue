<script setup>
import TakePicture from './TakePicture.vue';
import UploadImages from './UploadImages.vue';
import UploadVideos from './UploadVideos.vue';
import PublishPost from '../icons/PublishPost.vue';

import { useForm } from '@inertiajs/vue3';

import { toast } from "vue3-toastify";


const postForm = useForm({
    body: '',
})

const submitForm = () => {
    postForm.post(route('post.store'), {
        onSuccess: (page) => {
            postForm.reset();
            toast.success('Post created successfully');
        }
    })
}

</script>

<template>
    <div class="px-3 md:px-0">
        <form @submit.prevent="submitForm">
            <textarea name="post" id="post" rows="3" placeholder="Write your thoughts" class="w-full resize-none border-none rounded focus:outline-none focus:ring-gray-400" v-model="postForm.body"></textarea>
            <div class="flex justify-between items-center">
                <div class="flex gap-1 items-center">
                    <TakePicture class="w-8 h-8"/>
                    <UploadImages class="w-8 h-8"/>
                    <UploadVideos class="w-8 h-8"/>
                </div>
                <div>
                    <button type="submit" class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200">
                        <PublishPost class="w-8 h-8"/>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>