import axios from "axios";
import Cookies from "js-cookie";
import { notification, message } from "ant-design-vue";

const axiosClient = axios.create({
    // baseURL: ''
    baseURL: "https://medical.test/api/",
});

axiosClient.interceptors.request.use(async (config) => {
    const token = Cookies.get("token");
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

axiosClient.interceptors.response.use(
    async (response) => {
        return response;
    },
    async (error) => {
        const handleUnauthorizedError = async () => {
            try {
                Cookies.remove("token");
            } catch (err) {
                message.error(err);
            }
        };

        if (error?.response?.status === 401) {
            await handleUnauthorizedError();
            notification.error({ message: error.response.data.message });
        } else if (error?.response?.status === 403) {
            notification.error({
                message: "Forbidden 403",
                description: error.response.data.message,
            });
        } else {
            let msg = error.message;
            if (error.response?.data) {
                if (error.response.data.errors) {
                    msg = error.response.data.message;
                } else if (error.response.data.error) {
                    msg = error.response.data.error;
                } else if (error.response.data.message) {
                    msg = error.response.data.message;
                }
            }
            if (msg) {
                message.error(msg);
            }
        }
        return Promise.reject(error);
    },
);

export default axiosClient;
