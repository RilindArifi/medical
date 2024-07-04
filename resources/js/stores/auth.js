import { defineStore } from "pinia";
import axiosClient from "@/axios.js";
import Cookies from "js-cookie";
import router from "@/router/index.js";
import { defineAclRules } from "vue-simple-acl";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: {},
        token: Cookies.get("token") ?? null,
    }),
    actions: {
        async register(state) {
            this.isLoading = true;
            try {
                const { data } = await axiosClient.post("register", state);
                this.loadData(data);
                await this.setRules();
                await router.push({ name: "dashboard.index" });
            } catch (error) {}
        },
        async login(user) {
            try {
                const { data } = await axiosClient.post("login", user);
                this.loadData(data);
                await this.setRules();
                await router.push({ name: "dashboard.index" });
            } catch (error) {}
        },
        loadData(data) {
            Cookies.set("locale", "en");
            this.user = data.user;
            this.token = data.token;
            Cookies.set("token", data.token, {
                expires: new Date(
                    new Date().setDate(
                        new Date().getDate() + (data.remember ? 365 : 1),
                    ),
                ),
            });
        },
        async logout() {
            try {
                const response = await axiosClient.post("logout");
                if (response.status === 200) {
                    Cookies.remove("token");
                    this.token = null;
                    this.user = {};
                    // await this.setRules()
                    await router.go(0);
                }
            } catch (error) {}
        },
        async fetchUser() {
            if (Cookies.get("token")) {
                const response = await axiosClient.get("user");
                this.user = response.data.data;
            }
        },
        async setRules() {
            const permissions =
                this.user.permissions?.map((permission) => permission.name) ??
                [];
            return defineAclRules((setRule) => {
                setRule(this.user.role, (user) => true);
                permissions.forEach((permission) => {
                    setRule(
                        permission,
                        (user) =>
                            permissions && permissions.includes(permission),
                    );
                });
            });
        },
    },
});
