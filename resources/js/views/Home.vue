<template>
  <div class="w-1/4 shadow text-center overflow-none-scoll">
    <div class="bg-green-400 py-10 shadow sticky top-0">
      <img
        class="
          object-cover
          w-2/5
          inline-block
          border-2 border-green-400
          rounded-full
        "
        src="https://images.unsplash.com/photo-1520315342629-6ea920342047?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjR8fGNhdHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
        alt="Avatar"
      />
      <div class="mt-4 text-lg text-gray-800"><b>可愛小貓貓</b></div>
    </div>
    <div class="w-full shadow">
      <ul class="bg-green-300">
        <li
          class="
            p-4
            hover:bg-green-400 hover:text-green-200
            active:bg-green-500
            cursor-pointer
            select-none
          "
          v-for="i in videos"
          :key="i"
          @click="playVideo(i.id)"
        >
          {{ i.title }}
        </li>
      </ul>
    </div>
  </div>
  <div class="w-full">
    <div class="shadow p-4 bg-green-300">
      <div class="flex items-center">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 h-6 mr-2 text-green-600"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
          />
        </svg>
        <input
          type="text"
          placeholder="search"
          class="
            w-full
            py-2
            border-b-2
            outline-none
            bg-green-300
            border-green-500
            focus:border-green-600 focus:placeholder-green-600
            mr-5
          "
        />
        <router-link
          :to="{ name: 'videos.manage' }"
          class="w-1/12 rounded-md text-center ml-2 py-2 text-white bg-red-500"
          >管理</router-link
        >
      </div>
    </div>
    <div class="flex">
      <div class="p-5 w-5/6">
        <VideoPlayer :src="src" />
      </div>
    </div>
  </div>
</template>

<script>
import useVideos from "../composables/videos.js";

import VideoPlayer from "../components/VideoPlayer.vue";
import { onMounted, ref, reactive } from "vue";

export default {
  name: "App",
  components: {
    VideoPlayer,
  },
  setup() {
    const { videos, getVideos } = useVideos();

    const src = ref("");

    onMounted(getVideos);

    const playVideo = (id) => {
      src.value = `/api/videos/${id}/playurl`;
    };

    return {
      src,

      videos,
      playVideo,
    };
  },
};
</script>
