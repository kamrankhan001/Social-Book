<script setup>
import Modal from "@/Components/Modal.vue";
import Cross from "@/Components/app/icons/Cross.vue";

import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

import { toast } from "vue3-toastify";

import {
    CameraIcon,
    CheckCircleIcon,
    XCircleIcon,
} from "@heroicons/vue/24/outline";

import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
});

const coverImageForm = useForm({
    cover: null,
});

const coverImage = ref(null);
const changeCoverImage = ref(null);
const cropper = ref(null);
const processing = ref(false);
const isModelOpen = ref(false);

const coverHandle = (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
        changeCoverImage.value = URL.createObjectURL(file);
        isModelOpen.value = true;
    } else {
        toast.warn("The file must be an image");
    }
};

const crop = async () => {
    const { canvas } = cropper.value.getResult();
    if (canvas) {
        processing.value = true;
        await new Promise((resolve) => {
            canvas.toBlob((blob) => {
                const file = new File([blob], "cropped-image.png", {
                    type: blob.type,
                    lastModified: Date.now(),
                });
                coverImageForm.cover = file;
                isModelOpen.value = false;
                resolve();
            });
        });
        changeCoverImage.value = canvas.toDataURL();
        processing.value = false;
    }
};

const cancelCoverImage = () => {
    modelClose();
    changeCoverImage.value = null;
};

const saveCoverImage = async () => {
    await coverImageForm.post(
        route("profile.coverUpdate", { user: props.user.id }),
        {
            forceFormData: true,

            onSuccess: (page) => {
                changeCoverImage.value = null;
                coverImageForm.cover = null;
                toast.success("Cover image updated successfully.");
            },
            onError: (errors) => {
                toast.error(errors.cover || "Failed to update cover image.");
            },
        }
    );
};

const modelClose = () => {
    isModelOpen.value = false;
};
</script>

<template>
    <div>
        <div class="h-72 w-full relative group">
            <img
                :src="
                    changeCoverImage ||
                    user.cover_image ||
                    '/assets/imgs/cover.jpg'
                "
                alt="cover image"
                class="object-cover w-full h-full rounded"
            />
            <button
                v-if="!changeCoverImage"
                class="bg-gray-200 p-4 absolute top-1 left-2 flex gap-1 items-center font-medium rounded opacity-0 group-hover:opacity-100 transition-all cursor-pointer"
                @click="coverImage.click()"
            >
                <input
                    type="file"
                    id="cover_image"
                    class="absolute w-full z-50 hidden"
                    ref="coverImage"
                    @change="coverHandle"
                />

                Change Cover
                <CameraIcon class="size-6" />
            </button>
            <div v-else class="absolute top-2 left-2 flex items-center gap-2">
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
                <button class="absolute top-4 right-4" v-if="!processing">
                    <Cross class="w-8 h-8 cursor-pointer" @click="cancelCoverImage" />
                </button>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Crop Image
                    </h2>
                </header>
                <div class="max-h-[500px] overflow-auto">
                    <Cropper :src="changeCoverImage" ref="cropper" />
                </div>
                <footer class="flex justify-between items-center mt-4">
                    <button
                        type="button"
                        class="text-white border border-red-200 bg-red-600 px-3 py-1 rounded"
                        @click="cancelCoverImage"
                        :disabled="processing"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        @click="crop"
                        class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200"
                        :disabled="processing"
                    >
                        {{ processing ? "processing" : "Crop" }}
                    </button>
                </footer>
            </div>
        </Modal>
    </div>
</template>
