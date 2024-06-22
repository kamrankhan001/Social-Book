<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Groups from '@/Components/app/home/Groups.vue';
    import Followers from '@/Components/app/home/Followers.vue';
    import PostPanel from '@/Components/app/home/PostPanel.vue';
    import Posts from '@/Components/app/home/Posts.vue';


    import {
        Head
    } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="py-12 overflow-hidden h-[100vh]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-5">
                    <Groups/>
                    <main class="col-span-6 overflow-auto max-h-[30%]">
                       <PostPanel/>
                       <Posts/>
                    </main>
                    <Followers/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
