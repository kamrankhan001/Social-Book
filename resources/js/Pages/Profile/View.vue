<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pencil from '@/Components/app/icons/Pencil.vue';
    import {
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel
    } from '@headlessui/vue'
    import {
        usePage
    } from '@inertiajs/vue3';
    import {
        Head
    } from '@inertiajs/vue3';


    defineProps({
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
                <div class="flex flex-col items-center md:items-start px-1 md:px-0">
                    <div class="h-72 w-full">
                        <img src="https://plus.unsplash.com/premium_photo-1661972249683-790fcb064838?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="cover image" class="object-cover w-full h-full rounded">
                    </div>
                    <div class="flex flex-col items-center md:items-start md:flex-row md:justify-between w-full">
                        <div class="flex flex-col md:flex-row">
                            <div class="h-56 w-56 rounded-full -mt-44 md:-mt-28 flex-shrink-0 md:ml-5">
                                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="profile image" class="w-full h-full object-contain rounded-full border-2">
                            </div>
                            <p class="text-2xl font-medium capitalize text-center md:text-left">
                                {{ user . name }}
                                <small class="block lowercase">{{ user . email }}</small>
                            </p>
                        </div>
                        <div>
                            <button class="mt-2 bg-gray-200 px-4 py-2 flex gap-2 items-center rounded mx-auto md:mx-0 hover:bg-gray-300">
                                <Pencil class="h-6 w-6" /> <p class="text-xl font-medium">Edit</p>
                            </button>
                        </div>
                    </div>
                </div>
                <TabGroup>
                    <TabList class="flex space-x-1">
                        <Tab as="template" v-slot="{ selected }">
                            <button class="text-xl mr-3 focus:outline-nonep pr-1 md:pr-3"
                                :class="selected ? 'underline underline-offset-8 text-blue-600' : ''">
                                Personal Information
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="selected ? 'underline underline-offset-8 text-blue-600' : ''">
                                Posts
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="selected ? 'underline underline-offset-8 text-blue-600' : ''">
                                Followers
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="selected ? 'underline underline-offset-8 text-blue-600' : ''">
                                Following
                            </button>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <button class="text-xl mr-3 focus:outline-none px-2 md:px-3"
                                :class="selected ? 'underline underline-offset-8 text-blue-600' : ''">
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
