<script setup>
    import Modal from '@/Components/Modal.vue';
    import Camera from '../icons/Camera.vue';
    import PublishPost from '../icons/PublishPost.vue';
    import Cross from '../icons/Cross.vue';

    import {
        ref,
        onUnmounted
    } from 'vue';

    const video = ref(null);
    const canvas = ref(null);
    const capturedImage = ref(null);
    const showCanvas = ref(true);
    let stream = null;
    const isModelOpen = ref(false);


    const startCamera = async () => {
        try {
            modelOpen();
            stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            video.value.srcObject = stream;
        } catch (error) {
            console.error('Error accessing the camera: ', error);
        }
    };

    const stopCamera = () => {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
    };

    const captureImage = () => {
        const context = canvas.value.getContext('2d');
        canvas.value.width = video.value.videoWidth;
        canvas.value.height = video.value.videoHeight;
        context.drawImage(video.value, 0, 0, canvas.value.width, canvas.value.height);
        capturedImage.value = canvas.value.toDataURL('image/png');
        stopCamera();
        showCanvas.value = false;
    };

    const modelOpen = () => {
        isModelOpen.value = true;
    }
    const modelClose = () => {
        stopCamera();
        capturedImage.value = null;
        showCanvas.value = true;
        isModelOpen.value = false;
    }

    onUnmounted(() => {
        capturedImage.value = null;
        showCanvas.value = true;
        stopCamera();
    });
</script>

<template>
    <div>
        <Camera class="cursor-pointer"  @click="startCamera" />
        <Modal :show="isModelOpen" @close="modelClose" :closeable="false">
            <div class="p-6 bg-white rounded relative">
                <div class="absolute top-4 right-4">
                    <Cross class="w-8 h-8 cursor-pointer" @click="modelClose" />
                </div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Take Picture
                </h2>
                <div class="px-5">
                    <div class="" v-if="showCanvas">
                        <video ref="video" autoplay class="rounded bg-gray-200 mt-5"></video>
                        <canvas ref="canvas" class="hidden"></canvas>
                        <button @click="captureImage"
                            class="w-full p-3 bg-gray-100 hover:bg-gray-200">Capture</button>
                    </div>
                    <div v-if="capturedImage">
                        <h2>Captured Picture</h2>
                        <img :src="capturedImage" alt="Captured Image">
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <button type="button" class="text-white border border-red-200 bg-red-600 px-3 py-1 rounded"
                            @click="modelClose">Cancel</button>
                        <button type="submit" class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200">
                            <PublishPost class="w-8 h-8" />
                        </button>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>

<style scoped>
    .camera-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    video {
        width: 100%;
        max-width: 600px;
        border: 1px solid #ccc;
    }

    canvas.hidden {
        display: none;
    }

    button {
        margin-top: 10px;
    }

    img {
        margin-top: 10px;
        max-width: 100%;
    }
</style>
