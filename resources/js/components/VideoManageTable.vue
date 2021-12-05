<template>
  <div
    class="
      overflow-hidden overflow-x-auto
      min-w-full
      align-middle
      sm:rounded-md
    "
  >
    <table class="min-w-full border divide-y divide-gray-200">
      <thead>
        <tr>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
            >
              id
            </span>
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
            >
              title
            </span>
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
            >
              description
            </span>
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
            >
              original_name
            </span>
          </th>
          <th class="px-6 py-3 bg-gray-50">
            <span
              class="
                text-xs
                font-medium
                tracking-wider
                leading-4
                text-left text-gray-500
                uppercase
              "
            >
              feature
            </span>
          </th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <template v-for="video in videos" :key="video.id">
          <tr class="bg-white text-center">
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
              "
            >
              {{ video.id }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
              "
            >
              {{ video.title }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
                overflow-clip
              "
            >
              {{ video.description }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm
                leading-5
                text-gray-900
                whitespace-no-wrap
              "
            >
              {{ video.original_name }}
            </td>
            <td
              class="
                px-6
                py-4
                text-sm text-center
                leading-5
                text-gray-900
                whitespace-no-wrap
              "
            >
              <button
                @click="editVideo(video.id)"
                class="
                  inline-flex
                  items-center
                  px-4
                  py-2
                  bg-gray-800
                  border border-transparent
                  rounded-md
                  font-semibold
                  text-xs text-white
                  uppercase
                  tracking-widest
                  hover:bg-gray-700
                  active:bg-gray-900
                  focus:outline-none focus:border-gray-900 focus:ring
                  ring-gray-300
                  disabled:opacity-25
                  transition
                  ease-in-out
                  duration-150
                  mr-2
                "
              >
                Edit
              </button>
              <button
                @click="deleteVideo(video.id)"
                class="
                  inline-flex
                  items-center
                  px-4
                  py-2
                  bg-red-800
                  border border-transparent
                  rounded-md
                  font-semibold
                  text-xs text-white
                  uppercase
                  tracking-widest
                  hover:bg-red-700
                  active:bg-red-900
                  focus:outline-none focus:border-red-900 focus:ring
                  ring-red-300
                  disabled:opacity-25
                  transition
                  ease-in-out
                  duration-150
                "
              >
                Delete
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import useVideos from "../composables/videos";
import { onMounted } from "vue";

export default {
  setup() {
    const { videos, getVideos, destoryVideo } = useVideos();

    onMounted(getVideos);

    const editVideo = async (id) => {
      alert("敬請期待!");
    };

    const deleteVideo = async (id) => {
      if (!window.confirm("Are you sure ?")) return;

      await destoryVideo(id);
      await getVideos();
    };

    return {
      videos,
      editVideo,
      deleteVideo,
    };
  },
};
</script>
