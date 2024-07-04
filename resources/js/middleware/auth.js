import Cookies from "js-cookie";
import { useAuthStore } from "@/stores/auth.js";

export default async (to, from, next) => {
    if (!Cookies.get("token")) {
        next({ name: "login" });
    }
    await useAuthStore().fetchUser();
    next();
};
