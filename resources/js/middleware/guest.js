import Cookies from "js-cookie";
import {useAuthStore} from "@/stores/auth.js";

export default async (to, from, next) => {
    if(Cookies.get('token')) {
        await useAuthStore().fetchUser()
        next({name: 'dashboard.index'})
    }
    next();
}