<script setup>
    import Modal from '@/Components/Modal.vue';
    import Gallery from '../icons/Gallery.vue';
    import PublishPost from '../icons/PublishPost.vue';
    import Cross from '../icons/Cross.vue';
    import {
        ref
    } from 'vue';
    const imageFiles = ref([]);
    const images = ref([]);
    const isModelOpen = ref(false);

    const handleImages = (event) => {
        const files = Array.from(event.target.files);
        if (files.length) {
            images.value = files.map(file => URL.createObjectURL(file));
            modelOpen();
        }
    }

    const modelOpen = () => {
        isModelOpen.value = true;
    }

    const modelClose = () => {
        isModelOpen.value = false;
        images.value.forEach(URL.revokeObjectURL);
        images.value = [];
    }
</script>
<template>
    <div>
        <input type="file" name="images" id="images" accept="image/*" multiple class="hidden" @change="handleImages"
        ref="imageFiles">
        <Gallery class="cursor-pointer" @click="imageFiles.click()"/>
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
                    <div v-if="images.length > 1" class="grid grid-cols-2 gap-1">
                        <div v-for="(image, index) in images.slice(0, images.length)" :key="index">
                            <img :src="image" alt="post" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div v-else class="grid grid-cols-1">
                        <div>
                            <img :src="images[0]" alt="post" class="w-full h-full object-cover">
                        </div>
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
