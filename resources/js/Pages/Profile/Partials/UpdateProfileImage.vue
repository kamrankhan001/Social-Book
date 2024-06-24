<script setup>
import Modal from "@/Components/Modal.vue";
import Cross from "@/Components/app/icons/Cross.vue";
import Pencil from "@/Components/app/icons/Pencil.vue";

import { Cropper, CircleStencil } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

import { ref } from "vue";

defineProps({
    name: {type: String},
    email: {type: String}
})

const profileImge = ref(null);
const changeProfileImage = ref(null);
const isModelOpen = ref(false);
const copper = ref(null);

const profileHandle = (event) => {
    isModelOpen.value = true;
    const file = event.target.files[0];
    changeProfileImage.value = URL.createObjectURL(file);
};

const crop = () => {
    const { coordinates, canvas } = copper.value.getResult();
    changeProfileImage.value = canvas.toDataURL();
    modelClose();
};

const modelClose = () => {
    isModelOpen.value = false;
};
</script>

<template>
    <div class="flex flex-col md:flex-row items-center md:items-start px-1 md:px-0">
        <div
            class="h-56 w-56 rounded-full -mt-44 md:-mt-32 flex-shrink-0 md:ml-5 relative group"
        >
            <img
                :src="
                    changeProfileImage
                        ? changeProfileImage
                        : 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                "
                alt="profile image"
                class="w-full h-full object-contain rounded-full border-2"
            />
            <button
                class="bg-slate-700 opacity-0 w-full h-full rounded-full absolute top-0 grid place-items-center group-hover:opacity-50 transition-all" @click="profileImge.click()"
            >
                <input
                    type="file"
                    name="profile_image"
                    id="profile_image"
                    class="absolute w-full z-50 hidden"
                    ref="profileImge"
                    @change="profileHandle"
                />

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="#FFFFFF"
                    class="size-12"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"
                    />
                </svg>
            </button>
        </div>
        <div
            class="flex flex-col items-center md:items-start md:flex-row md:justify-between w-full z-50"
        >
            <div class="flex flex-col md:flex-row">
                <p
                    class="text-2xl font-medium capitalize text-center md:text-left"
                >
                    {{ name }}
                    <small class="block lowercase">{{ email }}</small>
                </p>
            </div>
            <div>
                <button
                    class=" bg-gray-200 px-4 py-2 flex gap-2 items-center rounded mx-auto md:mx-0 hover:bg-gray-300"
                >
                    <Pencil class="h-6 w-6" />
                    <p class="text-xl font-medium">Edit</p>
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
                    <cropper class="" :src="changeProfileImage" :stencil-component="CircleStencil" ref="copper" />
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
