<script setup>
import Camera from '../icons/Camera.vue';
import Gallery from '../icons/Gallery.vue';
import Album from '../icons/Album.vue';
import PublishPost from '../icons/PublishPost.vue';


</script>

<template>
    <div>
        <form action="#">
            <textarea name="post" id="post" rows="3" placeholder="Write your thoughts" class="w-full resize-none border-none rounded focus:outline-none focus:ring-gray-400"></textarea>
            <div class="flex justify-between items-center">
                <div class="flex gap-1 items-center">
                    <Camera class="w-8 h-8"/>
                    <Gallery class="w-8 h-8"/>
                    <Album class="w-8 h-8"/>
                </div>
                <div>
                    <button type="submit" class="bg-gray-50 px-5 py-1 rounded hover:bg-gray-200">
                        <PublishPost class="w-8 h-8"/>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>