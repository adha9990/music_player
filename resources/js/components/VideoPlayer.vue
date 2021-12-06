<template>
  <div class="relative group">
    <video id="video" class="" preload="auto" :src="src">
      你的瀏覽器不支援 HTML 5 video
    </video>
    <div
      class="
        absolute
        bottom-0
        bg-gray-700
        opacity-70
        group-hover:opacity-70
        transition-opacity
        w-full
        px-4
        py-2
      "
    >
      <button
        class="
          bg-transparent
          text-white
          font-semibold
          hover:text-white
          py-2
          px-4
          border border-white
          rounded
          mr-2
        "
        @click="play()"
      >
        {{ controls.play ? "播放" : "暫停" }}
      </button>
      <span>
        <button
          class="
            bg-transparent
            text-white
            font-semibold
            hover:text-white
            py-2
            px-4
            border border-white
            rounded
            mr-2
          "
          @click="muted()"
        >
          {{ controls.muted ? "取消靜音" : "靜音" }}
        </button>
        <input
          class="cursor-pointer"
          type="range"
          min="0"
          max="100"
          v-model="controls.volume"
          @change="change_volume()"
        />
      </span>
    </div>
  </div>
</template>

<script>
import { onMounted, ref, reactive } from "vue";

export default {
  props: {
    src: {
      type: String,
      required: true,
    },
  },
  setup() {
    const video = ref("");
    const controls = reactive({
      play: true,
      muted: false,
      volume: 100,
    });

    onMounted(() => {
      video.value = document.getElementById("video");
    });

    const play = () => {
      if (controls.play) {
        video.value.play();
      } else {
        video.value.pause();
      }
      controls.play = !controls.play;
    };

    const muted = () => {
      controls.muted = !controls.muted;
      video.value.muted = controls.muted;
    };

    const change_volume = () => {
      video.value.muted = controls.volume == 0;
      video.value.volume = controls.volume / 100;
    };

    return {
      video,
      controls,
      play,
      muted,
      change_volume,
    };
  },
};
</script>
