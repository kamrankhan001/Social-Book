<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateCoverImage from "./Partials/UpdateCoverImage.vue";
import UpdateProfileImage from "./Partials/UpdateProfileImage.vue";

import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import { usePage } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

import { ref } from "vue";

defineProps({
    user: Object,
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <div class="pb-12 pt-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <UpdateCoverImage />

                <UpdateProfileImage :name="user.name" :email="user.email" />

                

                <TabGroup>
                    <TabList class="flex space-x-1">
                        <Tab as="template" v-slot="{ selected }">
                            <button
                                class="text-xl mr-3 focus:outline-none pr-1 md:pr-3"
                                :class="
                                    selected
                                        ? 'underline underline-offset-8 text-blue-600'
                                        : ''
                                "
                            >
                                About
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button
                                class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="
                                    selected
                                        ? 'underline underline-offset-8 text-blue-600'
                                        : ''
                                "
                            >
                                Posts
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button
                                class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="
                                    selected
                                        ? 'underline underline-offset-8 text-blue-600'
                                        : ''
                                "
                            >
                                Followers
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button
                                class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="
                                    selected
                                        ? 'underline underline-offset-8 text-blue-600'
                                        : ''
                                "
                            >
                                Following
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button
                                class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="
                                    selected
                                        ? 'underline underline-offset-8 text-blue-600'
                                        : ''
                                "
                            >
                                Photos
                            </button>
                        </Tab>
                    </TabList>
                    <TabPanels>
                        <TabPanel>Content 1</TabPanel>
                        <TabPanel>Content 2</TabPanel>
                        <TabPanel>Content 3</TabPanel>
                        <TabPanel>Content 4</TabPanel>
                        <TabPanel>Content 5</TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.cropper {
    height: 288px;
    width: 10000px;
    background: #ddd;
}
</style>
