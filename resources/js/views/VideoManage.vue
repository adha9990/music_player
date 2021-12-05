<template>
  <div class="container mx-auto mt-5">
    <div class="flex place-content-between mb-4">
      <router-link
        :to="{ name: 'home' }"
        class="
          text-sm
          font-medium
          px-4
          py-2
          text-white
          bg-indigo-600
          hover:bg-indigo-700
          cursor-pointer
        "
        >Home</router-link
      >
      <router-link
        :to="{ name: 'videos.upload' }"
        class="
          text-sm
          font-medium
          px-4
          py-2
          text-white
          bg-indigo-600
          hover:bg-indigo-700
          cursor-pointer
        "
        >Upload Video</router-link
      >
    </div>

    <router-view></router-view>
  </div>
</template>
