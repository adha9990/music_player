<template>
  <form
    class="w-full max-w-lg p-4 bg-white mx-auto"
    enctype="multipart/form-data"
    @submit.prevent="saveVideo"
  >
    <h1 class="text-center mb-3 font-bold">Video Edit</h1>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-full px-3 mb-6 md:mb-0 mt-2">
        <label
          class="
            block
            uppercase
            tracking-wide
            text-gray-700 text-xs
            font-bold
            mb-2
          "
        >
          Title
          <input
            class="
              appearance-none
              block
              w-full
              text-gray-700
              rounded
              border
              py-3
              px-4
              mb-3
              leading-tight
              focus:outline-none focus:bg-white
            "
            type="text"
            placeholder="Title"
            v-model="video.title"
          />
        </label>
      </div>
      <div class="w-full md:w-full px-3 mb-6 md:mb-0 mt-2">
        <label
          class="
            block
            uppercase
            tracking-wide
            text-gray-700 text-xs
            font-bold
            mb-2
          "
        >
          Description
          <textarea
            class="
              w-full
              px-3
              py-2
              text-gray-700
              border
              rounded-lg
              focus:outline-none
            "
            rows="4"
            placeholder="Description"
            v-model="video.description"
          ></textarea>
        </label>
      </div>
    </div>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
      {{ errors }}
    </div>
    <button
      type="submit"
      class="
        w-full
        text-center
        px-4
        py-2
        bg-blue-500
        border border-transparent
        rounded-md
        font-semibold
        text-xs text-white
        uppercase
        tracking-widest
        hover:bg-blue-700
        active:bg-blue-900
        focus:outline-none focus:border-blue-900 focus:ring
        ring-blue-300
        disabled:opacity-25
        transition
        ease-in-out
        duration-150
      "
    >
      Submit
    </button>
  </form>
</template>

<script>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import useVideos from "../composables/videos";

export default {
  setup() {
    const { video, getVideo, updateVideo, errors } = useVideos();
    const route = useRoute();

    onMounted(() => {
      const id = route.params.id;
      getVideo(id);
    });

    const saveVideo = async () => {
      await updateVideo(video);
    };

    return {
      errors,
      video,
      saveVideo,
    };
  },
};
</script>
