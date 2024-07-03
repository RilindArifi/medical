import {defineStore} from "pinia";
import {get, set} from "lodash";
import axiosClient from ".././axios.js";

export const useSettingsStore = defineStore({
    id: "settings",
    state: () => ({
        settings: [],
    }),
    actions: {
        setSettings(settings) {
            this.settings = settings;
        },
        async loadSettings() {
            const response = await axiosClient.get('settings');
            this.settings = response.data;
        },
        setting(key, defaultValue = null) {
            return get(this.settings, key, defaultValue)
        },
        async setSetting(key, value) {
            const {data} = await axiosClient.post(`settings/update-single`, {key, value});

            set(this.settings, key, value);
        },
    },
});