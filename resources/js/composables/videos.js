import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useVideos() {
    const videos = ref([]);
    const video = ref([]);
    const errors = ref("");
    const router = useRouter();

    // const router = useRouter();

    const getVideos = async () => {
        let response = await axios.get("/api/videos");
        videos.value = response.data.data;
    };

    const getVideo = async (id) => {
        let response = await axios.get(`/api/videos/${id}`);
        video.value = response.data.data;
    };

    const destoryVideo = async (id) => {
        await axios.delete(`/api/videos/${id}`);
    };

    const storeVideo = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/videos", data);
            await router.push({ name: "videos.manage" });
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + " ";
                }
            }
        }
    };

    const updateVideo = async (id) => {
        errors.value = "";
        try {
            await axios.patch(`/api/videos/${id}`, video.value);
            await router.push({ name: "videos.manage" });
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + " ";
                }
            }
        }
    };

    const playVideo = async (id) => {};

    return {
        videos,
        video,
        errors,
        getVideos,
        getVideo,
        destoryVideo,
        storeVideo,
        updateVideo,
    };
}
