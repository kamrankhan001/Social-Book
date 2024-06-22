<script setup>
    import {
        ref
    } from "vue";
    import { Link } from '@inertiajs/vue3';


    const followers = ref([
        {
            id: 1,
            avater: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 2,
            avater: "https://picsum.photos/200",
            name: "Laravel Developers",
        },
        {
            id: 3,
            avater: "https://picsum.photos/200",
            name: "Laravel Developers",
        },
        {
            id: 4,
            avater: "https://picsum.photos/200",
            name: "Laravel Developers",
        },
        {
            id: 5,
            avater: "https://picsum.photos/200",
            name: "Laravel Developers",
        },
    ])
</script>

<template>
    <aside class="col-span-3 bg-gray-200 py-5 rounded max-h-[30%] overflow-auto">
        <h2 class="text-xl text-center text-white font-semibold py-2 bg-slate-800">
            Followers
        </h2>
        <form action="#" class="mb-2">
            <input type="search" name="followers" id="followers" placeholder="Search Followers" class="w-full border-none focus:outline-none focus:ring-gray-400">
        </form>
        <ul class="px-3 py-3">
            <li class="mb-3" v-for="follower in followers" :key="follower.id">
                <Link href="#" class="flex items-start"> 
                    <img :src="follower.avater" alt="group thumbnail" class="w-12 h-12 rounded-full mr-2">
                    <div>
                        <h3 class="font-medium capitalize">{{ follower.name }}</h3>
                    </div>
                </Link>
            </li>
        </ul>
    </aside>
</template>
