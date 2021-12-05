import { createRouter, createWebHistory } from "vue-router";

import Home from "./views/Home.vue";
import VideoManage from "./views/VideoManage.vue";

import VideoUpload from "./components/VideoUpload.vue";
import VideoManageTable from "./components/VideoManageTable.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: "home",
            path: "/",
            component: Home,
        },
        {
            path: "/manage",
            component: VideoManage,
            children: [
                {
                    name: "videos.manage",
                    path: "",
                    component: VideoManageTable,
                },
                {
                    name: "videos.upload",
                    path: "/upload",
                    component: VideoUpload,
                },
            ],
        },
    ],
});

export default router;
