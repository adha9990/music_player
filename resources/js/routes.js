import { createRouter, createWebHistory } from "vue-router";

import Home from "./views/Home.vue";
import VideoManage from "./views/VideoManage.vue";

import VideoManageTable from "./components/VideoManageTable.vue";
import VideoUpload from "./components/VideoUpload.vue";
import VideoEdit from "./components/VideoEdit.vue";

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
                {
                    name: "videos.edit",
                    path: "/edit/:id",
                    component: VideoEdit,
                },
            ],
        },
    ],
});

export default router;
