<script setup>
    import Modal from '@/Components/Modal.vue';
    import Album from '../icons/Album.vue';
    import PublishPost from '../icons/PublishPost.vue';
    import Cross from '../icons/Cross.vue';

    import {
        ref
    } from 'vue';

    const videoFile = ref(null);
    const videos = ref([]);
    const isModelOpen = ref(false);

    const handleVideo = (event) => {
        const files = Array.from(event.target.files);
        if (files.length) {
            videos.value = files.map(file => URL.createObjectURL(file));
            modelOpen();
        }
    }

    const modelOpen = () => {
        isModelOpen.value = true;
    }

    const modelClose = () => {
        isModelOpen.value = false;
        videos.value.forEach(URL.revokeObjectURL);
        videos.value = [];
    }
</script>
<template>
    <div>
        <input type="file" name="viedos" id="viedos" accept="video/*" multiple class="hidden" ref="videoFile"
            @change="handleVideo">
        <Album class="cursor-pointer" @click="videoFile.click()"/>
        <Modal :show="isModelOpen" @close="modelClose" :closeable="false">
            <div class="p-6 bg-white rounded relative">
                <div class="absolute top-4 right-4">
                    <Cross class="w-8 h-8 cursor-pointer" @click="modelClose" />
                </div>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Preview
                    </h2>
                </header>
                <div class="max-h-[500px] overflow-auto">
                    <div v-if="videos.length > 1" class="grid grid-cols-2 gap-1">
                        <div v-for="(video, index) in videos.slice(0, videos.length)" :key="index">
                            <video :src="video" controls class="w-full h-full object-cover"></video>
                        </div>
                    </div>
                    <div v-else class="grid grid-cols-1">
                        <video :src="videos[0]" controls class="w-full h-full object-cover"></video>
                    </div>
                </div>
                <footer class="flex justify-between items-center mt-4">
                    <button type="button" class="text-white border border-red-200 bg-red-600 px-3 py-1 rounded"
                        @click="modelClose">Cancel</button>
                    <button type="submit" class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200">
                        <PublishPost class="w-8 h-8" />
                    </button>
                </footer>
            </div>
        </Modal>
    </div>
</template>
