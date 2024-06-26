<script setup>
    import Modal from "@/Components/Modal.vue";
    import Cross from "@/Components/app/icons/Cross.vue";
    import Pencil from "@/Components/app/icons/Pencil.vue";

    import {
        Cropper,
        CircleStencil
    } from "vue-advanced-cropper";
    import "vue-advanced-cropper/dist/style.css";

    import {
        toast
    } from "vue3-toastify";

    import {
        CameraIcon,
        CheckCircleIcon,
        XCircleIcon,
    } from "@heroicons/vue/24/outline";


    import {
        ref
    } from "vue";
    import {
        useForm
    } from "@inertiajs/vue3";

    const props = defineProps({
        user: Object,
    });

    const avaterForm = useForm({
        avater: null,
    });

    const avater = ref(null);
    const changeAvater = ref(null);
    const cropper = ref(null);
    const processing = ref(false);
    const isModelOpen = ref(false);

    const avaterHandle = (event) => {
        const file = event.target.files[0];
        if (file && file.type.startsWith("image/")) {
            changeAvater.value = URL.createObjectURL(file);
            isModelOpen.value = true;
        } else {
            toast.warn("The file must be an image");
        }
    };

    const crop = async () => {
        const {
            canvas
        } = cropper.value.getResult();
        if (canvas) {
            processing.value = true;
            await new Promise((resolve) => {
                canvas.toBlob((blob) => {
                    const file = new File([blob], "cropped-image.png", {
                        type: blob.type,
                        lastModified: Date.now(),
                    });
                    avaterForm.avater = file;
                    isModelOpen.value = false;
                    resolve();
                });
            });
            changeAvater.value = canvas.toDataURL();
            processing.value = false;
        }
    };

    const cancelAvater = () => {
        modelClose();
        changeAvater.value = null;
    };

    const saveAvater = async () => {
        await avaterForm.post(
            route("profile.avaterUpdate", {
                user: props.user.id
            }), {
                forceFormData: true,

                onSuccess: (page) => {
                    changeAvater.value = null;
                    avaterForm.avater = null;
                    toast.success("Avater image updated successfully.");
                },
                onError: (errors) => {
                    toast.error(errors.avater || "Failed to update avater.");
                },
            }
        );
    };

    const modelClose = () => {
        isModelOpen.value = false;
    };
</script>

<template>
    <div class="flex flex-col md:flex-row items-center md:items-start px-1 md:px-0">
        <div class="h-56 w-56 rounded-full -mt-44 md:-mt-32 flex-shrink-0 md:ml-5 relative group">
            <img :src="changeAvater || user.avatar_image || '/assets/imgs/avater.jpg'" alt="avater"
                class="w-full h-full object-contain rounded-full border-2" />
            <button v-if="!changeAvater"
                class="bg-slate-700 opacity-0 w-full h-full rounded-full absolute top-0 grid place-items-center group-hover:opacity-50 transition-all"
                @click="avater.click()">
                <input type="file" name="profile_image" id="profile_image" class="absolute w-full z-50 hidden"
                    ref="avater" @change="avaterHandle" />

                <CameraIcon class="size-12 text-white" />
            </button>
            <div v-else class="absolute inset-0 flex items-center justify-center gap-2">
                <button
                    class="bg-green-500 text-white hover:bg-green-600 flex gap-1 items-center font-medium rounded px-3 py-1"
                    @click="saveAvater">
                    Save
                    <CheckCircleIcon class="size-6" />
                </button>
                <button
                    class="bg-red-500 text-white hover:bg-red-600 flex gap-1 items-center font-medium rounded  px-3 py-1"
                    @click="cancelAvater">
                    Cancel
                    <XCircleIcon class="size-6" />
                </button>
            </div>
        </div>
        <div class="flex flex-col items-center md:items-start md:flex-row md:justify-between w-full z-50">
            <div class="flex flex-col md:flex-row">
                <p class="text-2xl font-medium capitalize text-center md:text-left">
                    {{ user . name }}
                    <small class="block lowercase">{{ user . email }}</small>
                </p>
            </div>
            <div>
                <button
                    class=" bg-gray-200 px-4 py-2 flex gap-2 items-center rounded mx-auto md:mx-0 hover:bg-gray-300">
                    <Pencil class="h-6 w-6" />
                    <p class="text-xl font-medium">Edit</p>
                </button>
            </div>
        </div>
        <Modal :show="isModelOpen" @close="modelClose" :closeable="false">
            <div class="p-6 bg-white rounded relative">
                <div class="absolute top-4 right-4" v-if="!processing">
                    <Cross class="w-8 h-8 cursor-pointer" @click="cancelAvater" />
                </div>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Crop Image
                    </h2>
                </header>
                <div class="max-h-[500px] overflow-auto">
                    <Cropper class="cropper" :src="changeAvater" :stencil-component="CircleStencil"
                        :stencil-props="{
                            aspectRatio: 10 / 12
                        }"
                        ref="cropper" />
                </div>
                <footer class="flex justify-between items-center mt-4">
                    <button type="button" class="text-white border border-red-200 bg-red-600 px-3 py-1 rounded"
                        @click="cancelAvater" :disabled="processing">
                        Cancel
                    </button>
                    <button type="submit" @click="crop" class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200"
                        :disabled="processing">
                        {{ processing ? 'processing' : 'Crop' }}
                    </button>
                </footer>
            </div>
        </Modal>
    </div>
</template>

<style>
    .cropper {
        height: 600px;
        width: 600px;
        background: #DDD;
    }
</style>
