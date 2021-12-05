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
        {{ is_play ? "播放" : "暫停" }}
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
          {{ is_muted ? "取消靜音" : "靜音" }}
        </button>
        <input
          class="cursor-pointer"
          type="range"
          min="0"
          max="100"
          v-model="volume"
          @change="change_volume()"
        />
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    src: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      video: null,
      is_play: true,
      is_muted: false,
      volume: 100,
    };
  },
  mounted() {
    this.video = document.getElementById("video");
  },
  methods: {
    play() {
      if (this.is_play) {
        this.video.play();
      } else {
        this.video.pause();
      }
      this.is_play = !this.is_play;
    },
    muted() {
      this.is_muted = !this.is_muted;
      this.video.muted = this.is_muted;
    },
    change_volume() {
      this.is_muted = this.volume == 0;
      this.video.volume = this.volume / 100;
    },
  },
};
</script>
