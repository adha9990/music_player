<template>
  <form
    class="w-full max-w-lg p-4 bg-white mx-auto"
    enctype="multipart/form-data"
    @submit.prevent="saveVideo"
  >
    <h1 class="text-center mb-3 font-bold">Video Upload</h1>
    <label
      class="
        mb-5
        w-full
        flex flex-col
        items-center
        px-4
        py-6
        bg-white
        rounded-md
        shadow-md
        tracking-wide
        uppercase
        border border-blue
        cursor-pointer
        hover:bg-purple-600 hover:text-white
        text-purple-600
        ease-linear
        transition-all
        duration-150
      "
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-10 w-10"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
        />
      </svg>
      <span class="mt-2 text-base leading-normal">Select a file</span>
      <input
        type="file"
        class="hidden"
        @change="getSelectFile()"
        accept="video/*"
      />
    </label>
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
            v-model="form.title"
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
            v-model="form.description"
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
import { reactive } from "@vue/reactivity";
import useVideos from "../composables/videos";

export default {
  setup() {
    const form = reactive({
      title: "",
      description: "",
      file: "",
    });

    const { storeVideo, errors } = useVideos();

    const getSelectFile = () => {
      let file = event.target.files[0];
      form.file = file;
    };

    const saveVideo = async () => {
      let formData = new FormData();
      formData.append("title", form.title);
      formData.append("description", form.description);
      formData.append("file", form.file);

      await storeVideo(formData);
    };

    return {
      errors,
      form,
      saveVideo,
      getSelectFile,
    };
  },
};
</script>
