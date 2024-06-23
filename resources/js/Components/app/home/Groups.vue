<script setup>
    import {
        ref
    } from "vue";
    import {
        Link
    } from '@inertiajs/vue3';


    const groups = ref([{
            id: 1,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 2,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 3,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 4,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 5,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 6,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
        {
            id: 7,
            thumbnail: "https://picsum.photos/200",
            name: "Laravel Developers",
            description: " Lorem ipsum dolor sit, amet consectetur adipisicing elit"
        },
    ])
</script>

<template>
    <details class="order-1 col-span-12 md:col-span-3 max-h-[350px] rounded md:max-h-[30%] overflow-auto" open>
        <summary class="text-xl text-center text-white font-semibold py-2 bg-slate-800">
            Groups
        </summary>
        <div class="bg-gray-200">
            <form action="#" class="mb-2">
                <input type="search" name="groups" id="groups" placeholder="Search Groups"
                    class="w-full border-none focus:outline-none focus:ring-gray-400">
            </form>
            <ul class="px-3 py-3">
                <li class="mb-3" v-for="group in groups" :key="group.id">
                    <Link href="#" class="flex items-start">
                    <img :src="group.thumbnail" alt="group thumbnail" class="w-12 h-12 rounded-full mr-2">
                    <div>
                        <h3 class="font-medium capitalize">{{ group . name }}</h3>
                        <p class="text-gray-500">
                            {{ group . description }}
                        </p>
                    </div>
                    </Link>
                </li>
            </ul>
        </div>
    </details>
</template>
