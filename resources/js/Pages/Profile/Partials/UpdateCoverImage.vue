<script setup>
import Modal from "@/Components/Modal.vue";
import Cross from "@/Components/app/icons/Cross.vue";

import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

import {
    CameraIcon,
    CheckCircleIcon,
    XCircleIcon,
} from "@heroicons/vue/24/outline";

import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";

const CoverImageForm = useForm({
    cover: null,
});

const coverImage = ref(null);
const isModelOpen = ref(false);
const copper = ref(null);

const coverHandle = (event) => {
    isModelOpen.value = true;
    const file = event.target.files[0];
    CoverImageForm.cover = URL.createObjectURL(file);
};

const crop = () => {
    const { coordinates, canvas } = copper.value.getResult();
    CoverImageForm.cover = canvas.toDataURL();
    modelClose();
};

const cancelCoverImage = () => {
    CoverImageForm.cover = null;
};

const saveCoverImage = () => {
    CoverImageForm.patch(route("profile.coverUpdate"), {
        onSuccess: (page) => {
            console.log(page)
        },
        onError: (errors) => {
            console.log(errors)
        },
    });
};

const modelClose = () => {
    isModelOpen.value = false;
};

onMounted(console.log(initialPage.props.auth.user))
</script>

<template>
    <div>
        <div class="h-72 w-full relative group">
            <img
                :src="
                    CoverImageForm.cover ||
                    'https://plus.unsplash.com/premium_photo-1661972249683-790fcb064838?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                "
                alt="cover image"
                class="object-cover w-full h-full rounded"
            />
            <button
                v-if="!CoverImageForm.cover"
                class="bg-gray-200 p-4 absolute top-1 left-2 flex gap-1 items-center font-medium rounded opacity-0 group-hover:opacity-100 transition-all cursor-pointer"
                @click="coverImage.click()"
            >
                <input
                    type="file"
                    name="cover_image"
                    id="cover_image"
                    class="absolute w-full z-50 hidden"
                    ref="coverImage"
                    @change="coverHandle"
                />

                Change Cover
                <CameraIcon class="size-6" />
            </button>
            <div
                v-else
                class="absolute top-2 left-2 flex items-center gap-2 bg-black/40 rounded"
            >
                <button
                    class="bg-green-500 text-white hover:bg-green-600 flex gap-1 items-center font-medium rounded mr-2 px-3 py-1"
                    @click="saveCoverImage"
                >
                    Save
                    <CheckCircleIcon class="size-6" />
                </button>
                <button
                    class="bg-red-500 text-white hover:bg-red-600 flex gap-1 items-center font-medium rounded ml-2 px-3 py-1"
                    @click="cancelCoverImage"
                >
                    Cancel
                    <XCircleIcon class="size-6" />
                </button>
            </div>
        </div>
        <Modal :show="isModelOpen" @close="modelClose" :closeable="false">
            <div class="p-6 bg-white rounded relative">
                <div class="absolute top-4 right-4">
                    <Cross class="w-8 h-8 cursor-pointer" @click="modelClose" />
                </div>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Crop Image
                    </h2>
                </header>
                <div class="max-h-[500px] overflow-auto">
                    <cropper
                        class=""
                        :src="CoverImageForm.cover"
                        ref="copper"
                    />
                </div>
                <footer class="flex justify-between items-center mt-4">
                    <button
                        type="button"
                        class="text-white border border-red-200 bg-red-600 px-3 py-1 rounded"
                        @click="modelClose"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        @click="crop"
                        class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200"
                    >
                        Crop
                    </button>
                </footer>
            </div>
        </Modal>
    </div>
</template>
